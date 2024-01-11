<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardadm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_m');
    }

    // method untuk menampilkan dashboard Admin
    public function index()
    {
        $idakun = $this->session->userdata('idakun');
        $level = $this->session->userdata('idlevel');
        $data['permohonan'] = json_encode($this->Permohonan_m->permohonan($idakun));
        if ($level == '1'){
            $this->load->view('admin/components/header');
            $this->load->view('admin/components/navbar');
            $this->load->view('admin/dashboardadm', $data);
            $this->load->view('admin/components/sidebar');
            $this->load->view('admin/components/password');
        }else {
            redirect('Auth/Error');
        }
    }
}
