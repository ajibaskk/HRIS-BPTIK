<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller {

        public function index() {
                if ($this->session->has_userdata('user')) {
                        if ($this->input->post('submit-photo')) {
                                if ($_FILES['photo']['size'] != 0) {
                                        if ($_FILES['photo']['size'] <= 1024 * 1024 &&  $_FILES['photo']['size'] > 0) {
                                                if ($_FILES['photo']['type'] == 'image/jpeg' || $_FILES['photo']['type'] == 'image/png') {
                                                        $data = [
                                                                'foto' => file_get_contents($_FILES['photo']['tmp_name'])
                                                        ];
                                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                        if ($this->db->update('users', $data)) {
                                                                $this->session->set_flashdata('message', 'Anda telah mengganti foto profil');
                                                                $this->session->set_flashdata('message-photo', '');
                                                        }
                                                        $this->session->set_flashdata('error-message', 'Error saat mengganti foto profil');
                                                } else {
                                                        $this->session->set_flashdata('message-photo', 'Mohon pilih file foto!');
                                                }
                                        } else {
                                                $this->session->set_flashdata('message-photo', 'Foto tidak bisa lebih dari 1MB !');
                                        }
                                } else {
                                        $this->session->set_flashdata('message-photo', 'Mohon pilih foto!');
                                }
                        } else if ($this->input->post('submit-profile')) {
                                $this->load->library('form_validation');
                                $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
                                $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
                                $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim');
                                $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim');
                                $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                if ($this->form_validation->run()) {
                                        $data = [
                                                'nama' => htmlspecialchars($this->input->post('nama', true)),
                                                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                                                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                                                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                                                'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir', true))
                                        ];
                                        $this->db->where('nip', $this->session->userdata('user')['nip']);
                                        if ($this->db->update('users', $data)) {
                                                $this->session->set_flashdata('message', 'Profil anda telah dirubah');
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Error dalam perubahan profile');
                                        }
                                } else {
                                        $error = validation_errors('<p class="error text-danger">', '</p>');
                                        $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                }
                        } else if ($this->input->post('submit-password')) {
                                $this->load->library('form_validation');
                                $this->form_validation->set_rules('old-password', 'Password Lama', 'required|trim');
                                $this->form_validation->set_rules('new-password', 'Password Baru', 'required|trim|min_length[8]|max_length[32]');
                                $this->form_validation->set_rules('repeat-new-password', 'Ulang Password Baru', 'matches[new-password]');
                                $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
                                $this->form_validation->set_message('min_length', '%s minimal 8 karakter !');
                                $this->form_validation->set_message('max_length', '%s maksimal 32 karakter !');
                                $this->form_validation->set_message('matches', 'Password baru tidak sama !');

                                if ($this->form_validation->run()) {
                                        $old_password = $this->db->get_where('users', ['nip' => $this->session->userdata('user')['nip']])->row_array()['password'];
                                        if (password_verify($this->input->post('old-password'), $old_password)) {
                                                $data = [
                                                        'password' => password_hash($this->input->post('new-password'), PASSWORD_DEFAULT)
                                                ];
                                                $this->db->where('nip', $this->session->userdata('user')['nip']);
                                                if ($this->db->update('users', $data)) {
                                                        $this->session->set_flashdata('message', 'Anda telah mengganti password!');
                                                } else {
                                                        $this->session->set_flashdata('error-message', 'Error saat mengedit password');
                                                }
                                        } else {
                                                $this->session->set_flashdata('error-message', 'Password lama salah!');
                                                $this->session->set_flashdata('message-password', 'Password lama salah!');
                                        }
                                } else {
                                        $error = validation_errors('<p class="error text-danger">', '</p>');
                                        $this->session->set_flashdata('error-message', '<ul>' . $error . '</ul>');
                                }
                        }

                        $include['css'] = [base_url('assets/css/profile/profile.css')];
                        $include['js'] = [base_url('assets/js/profile/profile.js')];

                        $this->load->model('User_model');
                        $user = $this->User_model->getUser($this->session->userdata('user')['nip']);
                        $include['title'] = 'Profile | HRIS | BPTIK Jawa Tengah';


                        $include['data'] = [
                                'foto' => $user['foto'],
                                'nip' => $user['nip'],
                                'jenjang' => $user['jenjang'],
                                'nama' => $user['nama'],
                                'alamat' => $user['alamat'],
                                'jenis_kelamin' => $user['jenis_kelamin'],
                                'nama_unit' => $user['nama_unit'],
                                'tempat_lahir' => $user['tempat_lahir'],
                                'tanggal_lahir' => $user['tanggal_lahir'],
                        ];

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('profile/profile', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }
}
