<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Struktur extends CI_Controller
{
        public function index()
        {
                if ($this->session->has_userdata('user')) {
                        $include['css'] = [
                                base_url('assets/css/struktur/struktur.css'),
                        ];
                        $include['js'] = [
                        ];
                        $include['title'] = 'Struktur Organisasi | HRIS | BPTIK Jawa Tengah';
                        $include['struktur'] = 'active';

                        $this->load->model('User_model');

                        $include['kepala'] = $this->User_model->getPimpinan(0);
                        $include['tu'] = $this->User_model->getPimpinan(1);
                        $include['pengembangan'] = $this->User_model->getPimpinan(2);
                        $include['pemberdayaan'] = $this->User_model->getPimpinan(3);

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('struktur/struktur_organisasi', $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }
}