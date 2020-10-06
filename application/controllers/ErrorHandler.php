<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ErrorHandler extends CI_Controller
{
    public function noJs(){
        $this->load->view('errorHandler/no_js');
    }
    public function devTools(){
        $this->load->view('errorHandler/dev_tools');
    }
    public function error404(){
        $this->load->view('errorHandler/error404');
    }
    public function offline(){
        $this->load->view('errorHandler/offline');
    }
}
