<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{
    public function login()
    {
        $this->load->library('form_validation');
        if (!$this->session->has_userdata('user')) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_message('required', 'Form %s tidak boleh kosong !');
            if ($this->form_validation->run() == false) {
                $include['title'] = 'Login | HRIS | BPTIK Jawa Tengah';

                $this->load->view('authentication/login', $include);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->db->select('nama, nip, password, level, unit_kerja');
                $this->db->from('users');
                $this->db->where('nip =', $username);
                $user = $this->db->get()->row_array();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        switch ($user['level']) {
                            case 0:
                                $user_level = 'admin';
                                break;
                            case 1:
                                $user_level = 'pimpinan';
                                break;
                            case 2:
                                $user_level = 'pegawai';
                                break;
                        }

                        $data = [
                            'user' =>
                            [
                                'nip' => $user['nip'],
                                'unit' => $user['unit_kerja'],
                                'level' => $user_level
                            ]
                        ];
                        $this->session->set_userdata($data);
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukkan salah!</div>');
                        redirect(base_url('authentication/login'));
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak teregistrasi!</div>');
                    redirect(base_url('authentication/login'));
                }
            }
        } else {
            redirect(base_url());
        }
    }

    public function logout()
    {
        if ($this->session->has_userdata('user')) {
            $this->session->unset_userdata('user');
        }
        redirect(base_url('authentication/login'));
    }
}
