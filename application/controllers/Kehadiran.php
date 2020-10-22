<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends CI_Controller {

        public function daftar_kehadiran() {
                if ($this->session->has_userdata('user')) {
                        $this->load->model('Kehadiran_model');
                        $firstUpdate = $this->Kehadiran_model->getDateFirstUpdate();
                        $lastUpdate = $this->Kehadiran_model->getDateLastUpdate();
                        if ($this->input->post('submit-kehadiran')) {
                                $this->load->helper('file');
                                if ($_FILES['kehadiran']['size'] != 0) {
                                        if ($_FILES['kehadiran']['type'] == 'text/plain') {
                                                if ($file = fopen($_FILES['kehadiran']['tmp_name'], 'r')) {
                                                        $result = [];
                                                        while (!feof($file)) {
                                                                $line = fgets($file);
                                                                preg_match('/\d{8}/', $line, $idP);
                                                                preg_match('/\d{4}-\d{2}-\d{2}/', $line, $tanggal);
                                                                preg_match('/\d{2}:\d{2}:\d{2}/', $line, $jam);
                                                                if ($idP && $tanggal && $jam) {
                                                                        $idP = $idP[0];
                                                                        $tanggal = $tanggal[0];
                                                                        $jam = $jam[0];
                                                                        if (!(date('l', strtotime($tanggal)) == 'Saturday' || date('l', strtotime($tanggal)) == 'Sunday')) {
                                                                                if (strtotime($jam) > strtotime('06:00:00') && strtotime($jam) < strtotime('09:00:00')) {
                                                                                        if (!isset($result[$idP][$tanggal]['jam_masuk'])) {
                                                                                                $result[$idP][$tanggal]['jam_masuk'] = $jam;
                                                                                        }
                                                                                } else if (strtotime($jam) > strtotime('13:00:00') && strtotime($jam) < strtotime('24:00:00')) {
                                                                                        if (!isset($result[$idP][$tanggal]['jam_keluar'])) {
                                                                                                $result[$idP][$tanggal]['jam_keluar'] = $jam;
                                                                                        }
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                        fclose($file);

                                                        $itr = 0;
                                                        foreach ($result as $nip => $tanggal) {
                                                                foreach ($tanggal as $tgl => $jam) {
                                                                        if (count($jam) == 2) {
                                                                                $data[$itr] = [
                                                                                        'nip' => $nip,
                                                                                        'tanggal' => $tgl,
                                                                                        'jam_masuk' => $jam['jam_masuk'],
                                                                                        'jam_keluar' => $jam['jam_keluar']
                                                                                ];
                                                                                $itr++;
                                                                        }
                                                                }
                                                        }

                                                        foreach ($data as $data_item) {
                                                                $insert_query = $this->db->insert_string('kehadiran', $data_item);
                                                                $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                                                                $this->db->query($insert_query);
                                                        }

                                                        if (!strlen($this->db->error()['message'])) {
                                                                $this->session->set_flashdata('reload-message', 'Data kehadiran telah diupdate silakan klik tombol reload');
                                                        }
                                                        $this->session->set_flashdata('error-message', 'Gagal update (code: ' . $this->db->error()['code'] . '), ' . $this->db->error()['message']);
                                                }
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Mohon pilih file kehadiran dengan format .txt!');
                                        }
                                } else {
                                        $this->session->set_flashdata('error-message', 'Mohon pilih file!');
                                }
                        }

                        $include['css'] = [
                                base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css'),
                                base_url('assets/css/kehadiran/admin/daftar_kehadiran.css')
                        ];
                        $include['js_header'] = [
                                base_url('plugins/chart.js/Chart.min.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kehadiran/daftar_kehadiran.js')
                        ];
                        $include['title'] = 'Daftar Kehadiran | HRIS | BPTIK Jawa Tengah';
                        $include['daftar_kehadiran'] = 'active';

                        $this->load->model('User_model');
                        if ($this->session->userdata('user')['level'] == 'admin') {
                                $include["data_table"] = $this->User_model->getPegawais();
                        } else if ($this->session->userdata('user')['level'] == 'pimpinan') {
                                if ($this->session->userdata('user')['unit'] == 0 || $this->session->userdata('user')['unit'] == 1) {
                                        $include["data_table"] = $this->User_model->getPegawais();
                                } else {
                                        $include["data_table"] = $this->User_model->getPegawaisUnit($this->session->userdata('user')['unit']);
                                }
                        }

                        if ($this->input->post('select-kehadiran')) {
                                $year = $this->input->post('tahun-kehadiran');
                                $month = $this->input->post('bulan-kehadiran');
                        } else {
                                $year = date("Y", strtotime($lastUpdate));
                                $month = date("m", strtotime($lastUpdate));
                        }

                        $include['list_year'] = $this->Kehadiran_model->getListYearFirstLast();
                        $include['list_month'] = $this->Kehadiran_model->getListMonthFirstLast($year);
                        $include['select_year'] = $year;
                        $include['select_month'] = $month;

                        $i = 0;
                        foreach ($include["data_table"] as $data) {
                                $include["data_table"][$i]['telat'] = $this->Kehadiran_model->getCountLate($data['nip'], $month, $year);
                                $include["data_table"][$i]['tidak_hadir'] = $this->Kehadiran_model->getCountNotPresent($data['nip'],  $month, $year);
                                $include["data_table"][$i]['hadir'] = $this->Kehadiran_model->getCountPresent($data['nip'],  $month, $year);
                                $i++;
                        }
                        $include['first_update'] = date("d/m/Y", strtotime($firstUpdate));
                        $include['last_update'] = date("d/m/Y", strtotime($lastUpdate));


                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kehadiran/' . $this->session->userdata('user')['level'] . '/daftar_kehadiran', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function struktur_unit() {
                if ($this->session->has_userdata('user')) {
                        $include['css'] = [
                                base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css'),
                                base_url('assets/css/struktur/struktur.css')
                        ];
                        $include['js_header'] = [
                                base_url('plugins/chart.js/Chart.min.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kehadiran/struktur_unit.js')
                        ];
                        $include['title'] = 'Data Kehadiran | HRIS | BPTIK Jawa Tengah';
                        $include['struktur_unit'] = 'active';

                        $this->load->model('User_model');

                        $include['kepala'] = $this->User_model->getPimpinan(0);
                        $include['tu'] = $this->User_model->getPimpinan(1);
                        $include['pengembangan'] = $this->User_model->getPimpinan(2);
                        $include['pemberdayaan'] = $this->User_model->getPimpinan(3);

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kehadiran/' . $this->session->userdata('user')['level'] . '/struktur_unit', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function cek_kehadiran() {
                if ($this->session->has_userdata('user')) {
                        $include['css'] = [
                                base_url('plugins/fullcalendar/main.min.css'),
                                base_url('plugins/fullcalendar-daygrid/main.min.css'),
                                base_url('plugins/fullcalendar-timegrid/main.min.css'),
                                base_url('plugins/fullcalendar-bootstrap/main.min.css'),
                                base_url('assets/css/kehadiran/pegawai/cek_kehadiran.css')
                        ];
                        $include['js_header'] = [
                                base_url('plugins/moment/moment.min.js'),
                                base_url('plugins/fullcalendar/main.min.js'),
                                base_url('plugins/fullcalendar-daygrid/main.min.js'),
                                base_url('plugins/fullcalendar-timegrid/main.min.js'),
                                base_url('plugins/fullcalendar-interaction/main.min.js'),
                                base_url('plugins/fullcalendar-bootstrap/main.min.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kehadiran/pegawai/cek_kehadiran.js')
                        ];
                        $include['title'] = 'Cek Kehadiran | HRIS | BPTIK Jawa Tengah';
                        $include['cek_kehadiran'] = 'active';
                        $this->load->model('Kehadiran_model');
                        $include['first_update'] = date("d/m/Y", strtotime($this->Kehadiran_model->getDateFirstUpdate()));
                        $include['last_update'] = date("d/m/Y", strtotime($this->Kehadiran_model->getDateLastUpdate()));
                        $include['nip'] = $this->session->userdata('user')['nip'];

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kehadiran/' . $this->session->userdata('user')['level'] . '/cek_kehadiran', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function analisis_kehadiran() {
                if ($this->session->has_userdata('user')) {
                        $include['js_header'] = [base_url('plugins/chart.js/Chart.min.js')];
                        $include['js'] = [base_url('assets/js/kehadiran/pegawai/analisis_kehadiran.js')];
                        $include['title'] = 'Analisis Kehadiran | HRIS | BPTIK Jawa Tengah';
                        $include['analisis_kehadiran'] = 'active';
                        $this->load->model('Kehadiran_model');
                        $include['first_update'] = date("d/m/Y", strtotime($this->Kehadiran_model->getDateFirstUpdate()));
                        $include['last_update'] = date("d/m/Y", strtotime($this->Kehadiran_model->getDateLastUpdate()));

                        $this->load->model('Kehadiran_model');

                        $year = date("Y", strtotime($this->Kehadiran_model->getDateLastUpdate()));
                        $include['list_year'] = $this->Kehadiran_model->getListYearFirstLast();
                        $include['list_month'] = $this->Kehadiran_model->getListMonthFirstLast($year);

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kehadiran/' . $this->session->userdata('user')['level'] . '/analisis_kehadiran', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }
}
