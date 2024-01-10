<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }

    // method untuk menampilkan dashboard Master
    public function index()
    {
        $level = $this->session->userdata('idlevel');
        if ($level == '10'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar');
            $this->load->view('master/dashboardms');
            $this->load->view('master/components/sidebar'); 
        }else {
            redirect('Auth/Error');
        }
    }
}
