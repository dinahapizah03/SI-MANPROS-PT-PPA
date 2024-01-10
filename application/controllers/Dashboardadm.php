<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardadm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // method untuk menampilkan dashboard Admin
    public function index()
    {
        $level = $this->session->userdata('idlevel');
        if ($level == '1'){
            $this->load->view('admin/components/header');
            $this->load->view('admin/components/navbar');
            $this->load->view('admin/dashboardadm');
            $this->load->view('admin/components/sidebar');
        }else {
            redirect('Auth/Error');
        }
    }
}
