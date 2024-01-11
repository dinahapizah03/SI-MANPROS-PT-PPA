<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardsh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_m');
    }

    //tampilan dashboard SH
    public function index()
    {
        $data['laporan'] = $this->Laporan_m->laporan();
        $data['count_complete'] = $this->Laporan_m->count_statuscomplete();
        $data['count_ditolak'] = $this->Laporan_m->count_statusditolak();
        $level = $this->session->userdata('idlevel');
        if ($level == '3'){
            $this->load->view('sectionhead/components/header');
            $this->load->view('sectionhead/components/navbar');
            $this->load->view('sectionhead/dashboardsh', $data); 
            $this->load->view('sectionhead/components/sidebar'); 
            $this->load->view('sectionhead/components/password');
        }else {
            redirect('Auth/Error');
        }
    }    
}
