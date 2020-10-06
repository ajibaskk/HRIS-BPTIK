<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

        public function index()
        {
                if ($this->session->has_userdata('user')) {
                        $include['title'] = 'HRIS | BPTIK Jawa Tengah';
                        $include['beranda'] = 'active';

                        $this->load->view('templates/' . $this->session->userdata('user')['level'] . '/header', $include);
                        $this->load->view('beranda/' . $this->session->userdata('user')['level'], $include);
                        $this->load->view('templates/footer', $include);
                } else {
                        redirect(base_url('authentication/login'));
                }
        }
}