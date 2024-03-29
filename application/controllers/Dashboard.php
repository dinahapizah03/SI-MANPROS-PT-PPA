<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    // method untuk pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_m'); 
    }
    
    // method untuk tampilan dahsboard GL
    public function index()
    {
        $dept = $this->session->userdata('iddepartemen');
        $data['laporan'] = $this->Laporan_m->laporan($dept);
        $data['count_disetujui'] = $this->Laporan_m->count_statusdisetujui($dept);
        $data['count_ditolak'] = $this->Laporan_m->count_statusditolak($dept);
        $level = $this->session->userdata('idlevel');
        if ($level == '9'){
            $this->load->view('groupleader/components/header');
            $this->load->view('groupleader/components/navbar');
            $this->load->view('groupleader/dashboard', $data); 
            $this->load->view('groupleader/components/sidebar');
            $this->load->view('groupleader/components/password');
        }else {
            redirect('Auth/Error');
        }
    }
}
