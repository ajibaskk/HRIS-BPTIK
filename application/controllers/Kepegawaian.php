<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepegawaian extends CI_Controller
{

        public function daftar_pegawai()
        {
                if ($this->session->has_userdata('user')) {
                        $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                        $include['js_header'] = [
                                base_url('plugins/moment/moment.min.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kepegawaian/daftar_pegawai.js')
                        ];
                        $include['title'] = 'Daftar Pegawai | HRIS | BPTIK Jawa Tengah';
                        $include['daftar_pegawai'] = 'active';

                        $this->load->model('User_model');
                        $include["data_table"] = $this->User_model->getPegawais();
                        $i = 0;
                        foreach ($include["data_table"] as $data) {
                                if ($data['jenis_kelamin'] == 0) {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Laki-laki';
                                } else {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Perempuan';
                                }

                                $i++;
                        }
                        $j = 0;
                        foreach ($include["data_table"] as $data) {
                                if ($data['jenjang'] == 0) {
                                        $include["data_table"][$j]['jenjang'] = 'SMA/SMK';
                                } else if ($data['jenjang'] == 1) {
                                        $include["data_table"][$j]['jenjang'] = 'D3';
                                } else if ($data['jenjang'] == 2) {
                                        $include["data_table"][$j]['jenjang'] = 'S1';
                                } else if ($data['jenjang'] == 3) {
                                        $include["data_table"][$j]['jenjang'] = 'S2';
                                } else if ($data['jenjang'] == 4) {
                                        $include["data_table"][$j]['jenjang'] = 'S3';
                                }

                                $j++;
                        }

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/daftar_pegawai', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function menu_cuti_pegawai()
        {
                if ($this->session->has_userdata('user')) {
                        // $include['css'] = [base_url('assets/css/beranda/index.css')];
                        // $include['js'] = [base_url('assets/js/beranda/index.js')];
                        $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                        $include['cuti_pegawai'] = 'active';

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/menu_cuti', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function acc_cuti_pegawai()
        {
                if ($this->session->has_userdata('user')) {
                        if ($this->input->post('tolak-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('tolak-cuti'));
                                $data = [
                                        'persetujuan' => 2
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah ditolak!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam penolakan permohonan cuti');
                                }
                        } else if ($this->input->post('setuju-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('setuju-cuti'));
                                $data = [
                                        'persetujuan' => 1
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah disetujui!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam menyetujui permohonan cuti');
                                }
                        } else if ($this->input->post('batal-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('batal-cuti'));
                                $data = [
                                        'persetujuan' => 0
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah dibatalkan!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam membatalkan persetujuan');
                                }
                        }


                        $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                        $include['js_header'] = [
                                base_url('plugins/moment/moment.min.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kepegawaian/acc_cuti_pegawai.js')
                        ];
                        $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                        $include['cuti_pegawai'] = 'active';

                        $this->load->model('Cuti_model');
                        if ($this->session->userdata('user')['level'] == 'admin') {
                                $include["data_table"] = $this->Cuti_model->getCutis();
                        } else if ($this->session->userdata('user')['level'] == 'pimpinan') {
                                if ($this->session->userdata('user')['unit'] == 0) {
                                        $include["data_table"] = $this->Cuti_model->getCutis();
                                } else {
                                        $include["data_table"] = $this->Cuti_model->getCutisUnit($this->session->userdata('user')['unit']);
                                }
                        }

                        $i = 0;
                        foreach ($include["data_table"] as $data) {
                                $include["data_table"][$i]['no'] = $i + 1;
                                if ($data['jenis_kelamin'] == 0) {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Laki-laki';
                                } else {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Perempuan';
                                }

                                $i++;
                        }

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/acc_cuti_pegawai', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }


        public function cuti_pegawai($jenis)
        {
                if ($this->session->has_userdata('user')) {
                        if ($jenis == 'sakit') {
                                if ($this->input->post('submit-cuti')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
                                        $validasitanggal = array(
                                                array('field' => 'awal-cuti', 'label' => 'Tanggal Awal Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                                array('field' => 'akhir-cuti', 'label' => 'Tanggal Akhir Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                        );
                                        $this->form_validation->set_rules($validasitanggal);
                                        // $this->form_validation->set_rules('awal-cuti', 'Awal Cuti', 'required');
                                        // $this->form_validation->set_rules('akhir-cuti', 'Akhir Cuti', 'required');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        if ($this->form_validation->run()) {
                                                if ($_FILES['file-cuti']['size'] != 0) {
                                                        if ($_FILES['file-cuti']['size'] <= 5 * 1024 * 1024 &&  $_FILES['file-cuti']['size'] > 0) {
                                                                if ($_FILES['file-cuti']['type'] == 'application/pdf') {
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 1,
                                                                                'persetujuan' => 0,
                                                                                'type' => 0,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else if ($_FILES['file-cuti']['type'] == 'image/jpeg' || $_FILES['file-cuti']['type'] == 'image/png'){
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 1,
                                                                                'persetujuan' => 0,
                                                                                'type' => 1,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else {
                                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file foto!');
                                                                }
                                                        } else {
                                                                $this->session->set_flashdata('error-message', 'File tidak bisa lebih dari 5MB !');
                                                        }
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file!');
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                }
                                // $include['css'] = [base_url('assets/css/beranda/index.css')];
                                $include['js'] = [base_url('assets/js/kepegawaian/pengajuan_cuti.js')];
                                $this->load->model('User_model');
                                $user = $this->User_model->getUser($this->session->userdata('user')['nip']);
                                $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                                $include['cuti_pegawai'] = 'active';

                                $include['data'] = [
                                        'foto' => $user['foto'],
                                        'nip' => $user['nip'],
                                        'nama' => $user['nama'],
                                        'alamat' => $user['alamat'],
                                        'jenis_kelamin' => $user['jenis_kelamin'],
                                        'nama_unit' => $user['nama_unit'],
                                        'tempat_lahir' => $user['tempat_lahir'],
                                        'tanggal_lahir' => $user['tanggal_lahir'],
                                ];

                                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                                $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/cuti_pegawai/sakit', $include);
                                $this->load->view('templates/footer', $include);
                        } else if ($jenis == 'kepentingan') {
                                if ($this->input->post('submit-cuti')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
                                        $validasitanggal = array(
                                                array('field' => 'awal-cuti', 'label' => 'Tanggal Awal Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                                array('field' => 'akhir-cuti', 'label' => 'Tanggal Akhir Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                        );
                                        $this->form_validation->set_rules($validasitanggal);
                                        // $this->form_validation->set_rules('awal-cuti', 'Awal Cuti', 'required');
                                        // $this->form_validation->set_rules('akhir-cuti', 'Akhir Cuti', 'required');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        if ($this->form_validation->run()) {
                                                if ($_FILES['file-cuti']['size'] != 0) {
                                                        if ($_FILES['file-cuti']['size'] <= 5 * 1024 * 1024 &&  $_FILES['file-cuti']['size'] > 0) {
                                                                if ($_FILES['file-cuti']['type'] == 'application/pdf') {
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 2,
                                                                                'persetujuan' => 0,
                                                                                'type' => 0,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else if ($_FILES['file-cuti']['type'] == 'image/jpeg' || $_FILES['file-cuti']['type'] == 'image/png'){
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 2,
                                                                                'persetujuan' => 0,
                                                                                'type' => 1,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else {
                                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file foto!');
                                                                }
                                                        } else {
                                                                $this->session->set_flashdata('error-message', 'File tidak bisa lebih dari 5MB !');
                                                        }
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file!');
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                }
                                // $include['css'] = [base_url('assets/css/beranda/index.css')];
                                $include['js'] = [base_url('assets/js/kepegawaian/pengajuan_cuti.js')];
                                $this->load->model('User_model');
                                $user = $this->User_model->getUser($this->session->userdata('user')['nip']);
                                $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                                $include['cuti_pegawai'] = 'active';

                                $include['data'] = [
                                        'foto' => $user['foto'],
                                        'nip' => $user['nip'],
                                        'nama' => $user['nama'],
                                        'alamat' => $user['alamat'],
                                        'jenis_kelamin' => $user['jenis_kelamin'],
                                        'nama_unit' => $user['nama_unit'],
                                        'tempat_lahir' => $user['tempat_lahir'],
                                        'tanggal_lahir' => $user['tanggal_lahir'],
                                ];

                                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                                $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/cuti_pegawai/kepentingan', $include);
                                $this->load->view('templates/footer', $include);
                        } else if ($jenis == 'bersalin') {
                                if ($this->input->post('submit-cuti')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('alasan', 'Alasan', 'required|trim');
                                        $validasitanggal = array(
                                                array('field' => 'awal-cuti', 'label' => 'Tanggal Awal Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                                array('field' => 'akhir-cuti', 'label' => 'Tanggal Akhir Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                        );
                                        $this->form_validation->set_rules($validasitanggal);
                                        // $this->form_validation->set_rules('awal-cuti', 'Awal Cuti', 'required');
                                        // $this->form_validation->set_rules('akhir-cuti', 'Akhir Cuti', 'required');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        if ($this->form_validation->run()) {
                                                if ($_FILES['file-cuti']['size'] != 0) {
                                                        if ($_FILES['file-cuti']['size'] <= 5 * 1024 * 1024 &&  $_FILES['file-cuti']['size'] > 0) {
                                                                if ($_FILES['file-cuti']['type'] == 'application/pdf') {
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 3,
                                                                                'persetujuan' => 0,
                                                                                'type' => 0,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else if ($_FILES['file-cuti']['type'] == 'image/jpeg' || $_FILES['file-cuti']['type'] == 'image/png'){
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 3,
                                                                                'persetujuan' => 0,
                                                                                'type' => 1,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else {
                                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file foto!');
                                                                }
                                                        } else {
                                                                $this->session->set_flashdata('error-message', 'File tidak bisa lebih dari 5MB !');
                                                        }
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file!');
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                }
                                // $include['css'] = [base_url('assets/css/beranda/index.css')];
                                $include['js'] = [base_url('assets/js/kepegawaian/pengajuan_cuti.js')];
                                $this->load->model('User_model');
                                $user = $this->User_model->getUser($this->session->userdata('user')['nip']);



                                $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                                $include['cuti_pegawai'] = 'active';

                                $include['data'] = [
                                        'foto' => $user['foto'],
                                        'nip' => $user['nip'],
                                        'nama' => $user['nama'],
                                        'alamat' => $user['alamat'],
                                        'jenis_kelamin' => $user['jenis_kelamin'],
                                        'nama_unit' => $user['nama_unit'],
                                        'tempat_lahir' => $user['tempat_lahir'],
                                        'tanggal_lahir' => $user['tanggal_lahir'],
                                ];

                                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                                $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/cuti_pegawai/bersalin', $include);
                                $this->load->view('templates/footer', $include);
                        }
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function riwayat_cuti_pegawai()
        {
                if ($this->session->has_userdata('user')) {

                        if ($this->input->post('hapus-cuti')) {
                                $id =  $this->input->post('hapus-cuti');
                                if ($this->db->delete('cuti_pegawai', ['id_cuti_pegawai' => $id])) {
                                        $this->session->set_flashdata('message', 'Riwayat Cuti telah dihapus!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam penghapusan riwayat cuti');
                                }
                        }
                        $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                        $include['js'] = [
                                base_url('plugins/moment/moment.min.js'),
                                base_url('assets/js/kepegawaian/riwayat_cuti.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['title'] = 'Cuti Pegawai | HRIS | BPTIK Jawa Tengah';
                        $include['riwayat_cuti_pegawai'] = 'active';

                        $this->load->model('Cuti_model');
                        $include["data_table"] = $this->Cuti_model->getCutisIndividu2($this->session->userdata('user')['nip']);

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/riwayat_cuti_pegawai', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function riwayat_dinas_luar()
        {
                if ($this->session->has_userdata('user')) {
                        if ($this->input->post('hapus-cuti')) {
                                $id =  $this->input->post('hapus-cuti');
                                if ($this->db->delete('cuti_pegawai', ['id_cuti_pegawai' => $id])) {
                                        $this->session->set_flashdata('message', 'Dinas Luar telah dihapus!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam penghapusan riwayat cuti');
                                }
                        }
                        if ($this->input->post('tolak-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('tolak-cuti'));
                                $data = [
                                        'persetujuan' => 2
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah ditolak!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam penolakan permohonan cuti');
                                }
                        } else if ($this->input->post('setuju-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('setuju-cuti'));
                                $data = [
                                        'persetujuan' => 1
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah disetujui!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam menyetujui permohonan cuti');
                                }
                        } else if ($this->input->post('batal-cuti')) {
                                $this->db->where('id_cuti_pegawai', $this->input->post('batal-cuti'));
                                $data = [
                                        'persetujuan' => 0
                                ];
                                if ($this->db->update('cuti_pegawai', $data)) {
                                        $this->session->set_flashdata('message', 'Persetujuan Cuti telah dibatalkan!');
                                } else {
                                        $this->session->set_flashdata('error-message', 'Error dalam membatalkan persetujuan');
                                }
                        }


                        $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                        $include['js_header'] = [
                                base_url('plugins/moment/moment.min.js'),
                                base_url('plugins/datatables/jquery.dataTables.js'),
                                base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                        ];
                        $include['js'] = [
                                base_url('assets/js/kepegawaian/riwayat_dinas_luar.js')

                        ];
                        $include['title'] = 'Dinas Luar | HRIS | BPTIK Jawa Tengah';
                        $include['riwayat_dinas_luar'] = 'active';
                        $this->load->model('User_model');
                        $include['pegawai'] = $this->User_model->getPegawais();

                        $this->load->model('Cuti_model');
                        if ($this->session->userdata('user')['level'] == 'admin') {
                                $include["data_table"] = $this->Cuti_model->getDinasLuar();
                        } else if ($this->session->userdata('user')['level'] == 'pimpinan') {
                                if ($this->session->userdata('user')['unit'] == 0) {
                                        $include["data_table"] = $this->Cuti_model->getDinasLuar();
                                } else {
                                        $include["data_table"] = $this->Cuti_model->getDinasLuarUnit($this->session->userdata('user')['unit']);
                                }
                        } else {
                                $include["data_table"] = $this->Cuti_model->getDinasLuarsIndividu($this->session->userdata('user')['nip']);
                        }

                        $i = 0;
                        foreach ($include["data_table"] as $data) {
                                $include["data_table"][$i]['no'] = $i + 1;
                                if ($data['jenis_kelamin'] == 0) {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Laki-laki';
                                } else {
                                        $include["data_table"][$i]['jenis_kelamin'] = 'Perempuan';
                                }

                                $i++;
                        }

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/riwayat_dinas_luar', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function tanggal_check()
        {
                $tanggalawal = strtotime($_POST['tanggal-awal']);
                $tanggalakhir = strtotime($_POST['tanggal-akhir']);

                if ($tanggalakhir >= $tanggalawal) {
                        return TRUE;
                } else {
                        $this->form_validation->set_message('tanggal_check', 'Tanggal akhir harus setelah tanggal awal');
                        return FALSE;
                }
        }
        public function tanggal_check_cuti()
        {
                $tanggalawal = strtotime($_POST['awal-cuti']);
                $tanggalakhir = strtotime($_POST['akhir-cuti']);

                if ($tanggalakhir >= $tanggalawal) {
                        return TRUE;
                } else {
                        $this->form_validation->set_message('tanggal_check_cuti', 'Tanggal akhir harus setelah tanggal awal');
                        return FALSE;
                }
        }

        public function form_dinas_luar()
        {
                if ($this->input->post('submit-cuti')) {
                        $this->load->library('form_validation');
                        $validasitanggal = array(
                                array('field' => 'awal-cuti', 'label' => 'Tanggal Awal Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                                array('field' => 'akhir-cuti', 'label' => 'Tanggal Akhir Cuti', 'rules' => 'required|callback_tanggal_check_cuti'),
                        );
                        $this->form_validation->set_rules($validasitanggal);
                        // $this->form_validation->set_rules('awal-cuti', 'Awal Cuti', 'required');
                        // $this->form_validation->set_rules('akhir-cuti', 'Akhir Cuti', 'required');
                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                        if ($this->form_validation->run()) {
                                if ($_FILES['file-cuti']['size'] != 0) {
                                        if ($_FILES['file-cuti']['size'] <= 5 * 1024 * 1024 &&  $_FILES['file-cuti']['size'] > 0) {
                                                if ($_FILES['file-cuti']['type'] == 'application/pdf') {
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 4,
                                                                                'persetujuan' => 0,
                                                                                'type' => 0,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else if ($_FILES['file-cuti']['type'] == 'image/jpeg' || $_FILES['file-cuti']['type'] == 'image/png'){
                                                                        $data = [
                                                                                'nip' => htmlspecialchars($this->session->userdata('user')['nip']),
                                                                                'alasan' => htmlspecialchars($this->input->post('alasan', true)),
                                                                                'tanggal_cuti_mulai' => htmlspecialchars($this->input->post('awal-cuti', true)),
                                                                                'tanggal_cuti_akhir' => htmlspecialchars($this->input->post('akhir-cuti', true)),
                                                                                'jenis' => 4,
                                                                                'persetujuan' => 0,
                                                                                'type' => 1,
                                                                                'file' => file_get_contents($_FILES['file-cuti']['tmp_name'])
                                                                        ];
                                                                        // var_dump($_FILES);

                                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                                        if ($this->db->insert('cuti_pegawai', $data)) {
                                                                                $this->session->set_flashdata('message', 'Pengajuan cuti anda berhasil, silahkan cek riwayat cuti anda!');
                                                                        } else {
                                                                                $this->session->set_flashdata('error-message', 'Error dalam pengajuan cuti');
                                                                        }
                                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Mohon pilih file foto!');
                                                }
                                        } else {
                                                $this->session->set_flashdata('error-message', 'File tidak bisa lebih dari 5MB !');
                                        }
                                } else {
                                        $this->session->set_flashdata('error-message', 'Mohon pilih file!');
                                }
                        } else {
                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                        }
                }
                // $include['css'] = [base_url('assets/css/beranda/index.css')];
                $include['js'] = [base_url('assets/js/kepegawaian/pengajuan_cuti.js')];
                $this->load->model('User_model');
                $user = $this->User_model->getUser($this->session->userdata('user')['nip']);
                $include['title'] = 'Form Dinas Luar | HRIS | BPTIK Jawa Tengah';
                $include['form_dinas_luar'] = 'active';

                $include['data'] = [
                        'foto' => $user['foto'],
                        'nip' => $user['nip'],
                        'nama' => $user['nama'],
                        'alamat' => $user['alamat'],
                        'jenis_kelamin' => $user['jenis_kelamin'],
                        'nama_unit' => $user['nama_unit'],
                        'tempat_lahir' => $user['tempat_lahir'],
                        'tanggal_lahir' => $user['tanggal_lahir'],
                ];

                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                $this->load->view('kepegawaian/' . $this->session->userdata('user')['level'] . '/form_dinas_luar', $include);
                $this->load->view('templates/footer', $include);
        }
}
