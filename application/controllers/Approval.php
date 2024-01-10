<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{
    // method pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'download');
        $this->load->model('Approval_m');
        $this->load->library('form_validation');
        
    }

    // method untuk menampilkan halaman approval
    public function index()
    {
        $data['approval'] = $this->Approval_m->approval();
        $level = $this->session->userdata('idlevel');
        if ($level == '9'){
            $this->load->view('groupleader/components/header');
            $this->load->view('groupleader/components/navbar'); 
            $this->load->view('groupleader/approval', $data); 
            $this->load->view('groupleader/components/sidebar');
        }else {
            redirect('Auth/Error');
        }
    }

    // method untuk mengapproval proposal pada halaman GL
    public function acc_laporan_gl()
    {
        $id_status_laporan = $this->uri->segment('3');
        // menentukan nilai id laporan
        $id_permohonan = $this->input->post("id_permohonan");
        $idlaporan = $this->input->post("idlaporan");
        $idakun = $this->session->userdata("idakun");
        $alasan = $this->input->post("alasan");
        // update permohonan
        // tambah history permohonan
        if($id_status_laporan == 2){
            $hasil = $this->Approval_m->confirm_laporan_gl($id_permohonan, $id_status_laporan, $alasan);
            $update_history = $this->Approval_m->add_history($id_permohonan, $id_status_laporan, $alasan, 12, $idakun);
        } else if($id_status_laporan == 3){
            $hasil = $this->Approval_m->confirm_laporan_gl($idlaporan, $id_status_laporan, $alasan);
            $update_history = $this->Approval_m->add_history($idlaporan, $id_status_laporan, $alasan, 13, $idakun);
        }
        if ($hasil == false) {
            $this->session->set_flashdata('eror_input', 'eror_input');
        } else { // Update level persetujuan jika status disetujui oleh GL
            $this->session->set_flashdata('input', 'input');
            redirect('approval'); // Redirect ke halaman riwayat laporan GL
        }
    }

    // method untuk mengupdate level persetujuan
    public function setujuLevel1($id_permohonan) 
    {
        // Logika persetujuan Level 1 GL
        $this->Approval_m->updateLevelPersetujuan($id_permohonan, 2); // Set level persetujuan menjadi 2 (Level 2 SH)
        redirect('approval'); // Redirect ke halaman riwayat laporan GL
    }
}