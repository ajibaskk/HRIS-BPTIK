<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller {
        public function manajemen_akun() {
                if ($this->session->has_userdata('user')) {
                        if ($this->session->userdata('user')['level'] == 'admin') {

                                if ($this->input->post('add-akun')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
                                        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[users.nip]');
                                        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
                                        $this->form_validation->set_rules('unit-kerja', 'Unit Kerja', 'required|trim');
                                        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
                                        $this->form_validation->set_rules('tempat-lahir', 'Tempat Lahir', 'trim');
                                        $this->form_validation->set_rules('tanggal-lahir', 'Tanggal Lahir', 'trim');
                                        $this->form_validation->set_rules('jenis-kelamin', 'Jenis Kelamin', 'required|trim');
                                        $this->form_validation->set_rules('level', 'Level', 'required|trim');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        $this->form_validation->set_message('is_unique', '%s telah terdaftar !');
                                        if ($this->form_validation->run()) {
                                                $data = [
                                                        'nama' => htmlspecialchars($this->input->post('nama', true)),
                                                        'nip' => htmlspecialchars($this->input->post('nip', true)),
                                                        'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                                                        'unit_kerja' => htmlspecialchars($this->input->post('unit-kerja', true)),
                                                        'jenjang' => htmlspecialchars($this->input->post('jenjang', true)),
                                                        'tempat_lahir' => htmlspecialchars($this->input->post('tempat-lahir', true)),
                                                        'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal-lahir', true)),
                                                        'jenis_kelamin' => htmlspecialchars($this->input->post('jenis-kelamin', true)),
                                                        'level' => htmlspecialchars($this->input->post('level', true)),
                                                        'password' => password_hash($this->input->post('nip'), PASSWORD_DEFAULT)
                                                ];
                                                if ($data['level'] == 1 && $this->db->get_where('users', 'level = ' . $data['level'] . ' AND unit_kerja = ' . $data['unit_kerja'])->num_rows() > 0) {
                                                        $this->session->set_flashdata('error-message', 'Akun pimpinan unit telah ada!');
                                                        $check = false;
                                                }
                                                $check = true;

                                                if ($check) {
                                                        if ($this->db->insert('users', $data) && !strlen($this->db->error()['message'])) {
                                                                $this->session->set_flashdata('message', 'Akun ' . $data['nama'] . ' (NIP.' . $data['nip'] . ') telah ditambahkan!');
                                                        } else {
                                                                $this->session->set_flashdata('error-message', 'Gagal tambah (code: ' . $this->db->error()['code'] . '), ' . $this->db->error()['message']);
                                                        }
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                } else if ($this->input->post('edit-akun')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
                                        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
                                        $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
                                        $this->form_validation->set_rules('unit-kerja', 'Unit Kerja', 'required|trim');
                                        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
                                        $this->form_validation->set_rules('tempat-lahir', 'Tempat Lahir', 'trim');
                                        $this->form_validation->set_rules('tanggal-lahir', 'Tanggal Lahir', 'trim');
                                        $this->form_validation->set_rules('jenis-kelamin', 'Jenis Kelamin', 'required|trim');
                                        $this->form_validation->set_rules('level', 'Level', 'required|trim');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        $this->form_validation->set_message('is_unique', '%s telah terdaftar !');
                                        if ($this->form_validation->run()) {
                                                $data = [
                                                        'nama' => htmlspecialchars($this->input->post('nama', true)),
                                                        'nip' => htmlspecialchars($this->input->post('nip', true)),
                                                        'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                                                        'unit_kerja' => htmlspecialchars($this->input->post('unit-kerja', true)),
                                                        'jenjang' => htmlspecialchars($this->input->post('jenjang', true)),
                                                        'tempat_lahir' => htmlspecialchars($this->input->post('tempat-lahir', true)),
                                                        'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal-lahir', true)),
                                                        'jenis_kelamin' => htmlspecialchars($this->input->post('jenis-kelamin', true)),
                                                        'level' => htmlspecialchars($this->input->post('level', true)),
                                                ];
                                                if ($data['level'] == 1 && $this->db->get_where('users', 'level = ' . $data['level'] . ' AND unit_kerja = ' . $data['unit_kerja'])->num_rows() > 0) {
                                                        $this->session->set_flashdata('error-message', 'Akun pimpinan unit telah ada!');
                                                        $check = false;
                                                } else {
                                                        $check = true;
                                                }
                                                if ($check) {
                                                        $this->db->where('nip', $this->input->post('edit-akun'));
                                                        if ($this->db->update('users', $data) && !strlen($this->db->error()['message'])) {
                                                                $this->session->set_flashdata('message', 'Akun ' . $data['nama'] . ' (NIP.' . $data['nip'] . ') telah diubah!');
                                                        } else if ($this->db->error()['code'] == 1062) {
                                                                $this->session->set_flashdata('error-message', 'ID.' . $data['nip'] . ' telah terdaftar!');
                                                        } else {
                                                                $this->session->set_flashdata('error-message', 'Gagal update (code: ' . $this->db->error()['code'] . '), ' . $this->db->error()['message']);
                                                        }
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                } else if ($this->input->post('hapus-akun')) {
                                        $nip =  $this->input->post('hapus-akun');
                                        $akun = $this->db->get_where('users', ['nip' => $nip])->row_array();
                                        if ($this->db->delete('users', ['nip' => $nip])) {
                                                $this->session->set_flashdata('message', 'Akun ' . $akun['nama'] . ' (NIP.' . $akun['nip'] . ') telah dihapus!');
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Error dalam penghapusan akun');
                                        }
                                } else if ($this->input->post('reset-password-akun')) {
                                        $data = [
                                                'password' => password_hash($this->input->post('reset-password-akun'), PASSWORD_DEFAULT)
                                        ];
                                        $this->db->where('nip', $this->input->post('reset-password-akun'));
                                        if ($this->db->update('users', $data) && !strlen($this->db->error()['message'])) {
                                                $this->session->set_flashdata('message', 'Password akun NIP.' . $this->input->post('reset-password-akun') . ' telah direset!');
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Gagal reset password (code: ' . $this->db->error()['code'] . '), ' . $this->db->error()['message']);
                                        }
                                }

                                $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                                $include['js_header'] = [
                                        base_url('plugins/moment/moment.min.js'),
                                        base_url('plugins/datatables/jquery.dataTables.js'),
                                        base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                                ];
                                $include['js'] = [
                                        base_url('assets/js/manajemen/manajemen_akun.js'),
                                ];
                                $include['title'] = 'Daftar Akun | HRIS | BPTIK Jawa Tengah';
                                $include['manajemen_akun'] = 'active';

                                $this->load->model('User_model');
                                $include["data_table"] = $this->User_model->getUsers();
                                $itr = 0;
                                foreach ($include["data_table"] as $data) {
                                        $include["data_table"][$itr]['no'] = $itr + 1;
                                        if ($data['jenis_kelamin'] == 0) {
                                                $include["data_table"][$itr]['jenis_kelamin'] = 'Laki-laki';
                                        } else {
                                                $include["data_table"][$itr]['jenis_kelamin'] = 'Perempuan';
                                        }

                                        if ($data['level'] == 0) {
                                                $include["data_table"][$itr]['level'] = 'Admin';
                                        } else if ($data['level'] == 1) {
                                                $include["data_table"][$itr]['level'] = 'Pimpinan';
                                        } else {
                                                $include["data_table"][$itr]['level'] = 'Pegawai';
                                        }
                                        $itr++;
                                }

                                $this->load->model('Unit_kerja_model');
                                $include["unit_kerja"] = $this->Unit_kerja_model->getUnitKerjas();

                                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                                $this->load->view('manajemen/' . $this->session->userdata('user')['level'] . '/manajemen_akun', $include);
                                $this->load->view('templates/footer', $include);
                        } else {
                                redirect(base_url());
                        }
                } else {
                        redirect(base_url('authentication/login'));
                }
        }

        public function manajemen_hari_libur() {
                if ($this->session->has_userdata('user')) {
                        if ($this->session->userdata('user')['level'] == 'admin') {

                                if ($this->input->post('add-hari-libur')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('nama-hari-libur', 'Jenis Libur', 'required|trim');
                                        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim|is_unique[hari_libur.tanggal]');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        $this->form_validation->set_message('is_unique', '%s telah terdaftar !');
                                        if ($this->form_validation->run()) {
                                                $data = [
                                                        'nama_hari_libur' => htmlspecialchars($this->input->post('nama-hari-libur', true)),
                                                        'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                                                ];
                                                if ($this->db->insert('hari_libur', $data)) {
                                                        $this->session->set_flashdata('message', 'Hari Libur ' . $data['nama_hari_libur'] . ' (' . $data['tanggal'] . ') telah telah ditambahkan!');
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Error dalam penambahan hari libur');
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                } else if ($this->input->post('edit-hari-libur')) {
                                        $this->load->library('form_validation');
                                        $this->form_validation->set_rules('nama-hari-libur', 'Jenis Libur', 'required|trim');
                                        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
                                        $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                        $this->form_validation->set_message('is_unique', '%s telah terdaftar !');
                                        if ($this->form_validation->run()) {
                                                $data = [
                                                        'nama_hari_libur' => htmlspecialchars($this->input->post('nama-hari-libur', true)),
                                                        'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                                                ];
                                                $this->db->where('id', $this->input->post('edit-hari-libur'));
                                                if ($this->db->update('hari_libur', $data)) {
                                                        $this->session->set_flashdata('message', 'Hari Libur ' . $data['nama_hari_libur'] . ' (' . date("d/m/Y", strtotime($data['tanggal'])) . ') telah telah diubah!');
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Error dalam perubahan hari libur');
                                                }
                                        } else {
                                                $error = validation_errors('<p class="error text-danger">', '</p>');
                                                $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                        }
                                } else if ($this->input->post('hapus-hari-libur')) {
                                        $idLibur =  $this->input->post('hapus-hari-libur');
                                        $libur = $this->db->get_where('hari_libur', ['id' => $idLibur])->row_array();
                                        if ($this->db->delete('hari_libur', ['id' => $idLibur])) {
                                                $this->session->set_flashdata('message', 'Hari Libur ' . $libur['nama_hari_libur'] . ' (' . date("d/m/Y", strtotime($libur['tanggal'])) . ') telah dihapus!');
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Error dalam penghapusan hari libur');
                                        }
                                }

                                $include['css'] = [base_url('plugins/datatables-bs4/css/dataTables.bootstrap4.css')];
                                $include['js_header'] = [
                                        base_url('plugins/datatables/jquery.dataTables.js'),
                                        base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js')
                                ];
                                $include['js'] = [
                                        base_url('assets/js/manajemen/manajemen_libur.js')
                                ];
                                $include['title'] = 'Daftar Hari Libur | HRIS | BPTIK Jawa Tengah';
                                $include['manajemen_hari_libur'] = 'active';

                                $this->load->model('Libur_model');
                                $include["data_table"] = $this->Libur_model->getLiburs();
                                $i = 0;
                                foreach ($include["data_table"] as $l) {
                                        $include["data_table"][$i]['no'] = $i + 1;
                                        $include["data_table"][$i]['id'] = $l['id'];
                                        $include["data_table"][$i]['nama_hari_libur'] = $l['nama_hari_libur'];
                                        $include["data_table"][$i]['tanggal'] = date("d/m/Y", strtotime($l['tanggal']));
                                        $i++;
                                }

                                $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                                $this->load->view('manajemen/' . $this->session->userdata('user')['level'] . '/manajemen_hari_libur', $include);
                                $this->load->view('templates/footer', $include);
                        } else {
                                redirect(base_url());
                        }
                } else {
                        redirect(base_url('authentication/login'));
                }
        }
}
