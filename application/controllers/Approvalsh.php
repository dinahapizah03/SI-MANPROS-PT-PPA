<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approvalsh extends CI_Controller
{
    // method untuk pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'download');
        $this->load->model('Approval_m');
        $this->load->library('form_validation');
        
    }

    // method untuk tampilan approval SH
    public function index()
    {
        $data['approval'] = $this->Approval_m->approval_sh();
        $this->load->view('sectionhead/components/header');
        $this->load->view('sectionhead/components/navbar'); 
        $this->load->view('sectionhead/approvalsh', $data); 
        $this->load->view('sectionhead/components/sidebar');
    }

    // method untuk approval proposal SH
    public function acc_laporan_sh()
    {
        $id_status_laporan = $this->uri->segment('3');;
        $id_permohonan = $this->input->post("id_permohonan");
        $idakun = $this->session->userdata("idakun");
        $idlaporan = $this->input->post("idlaporan");
        // menentukan nilai id laporan
        $alasan = $this->input->post("alasan");
        $hasil = 0;
        if($id_status_laporan == 4){
            $process = $this->Approval_m->confirm_laporan_sh($id_permohonan, 4, $alasan);
            $update_history = $this->Approval_m->add_history($id_permohonan, 4, $alasan, 21, $idakun);
            $hasil = 1;
            
        } else if($id_status_laporan == 3){
            $process = $this->Approval_m->confirm_laporan_sh($idlaporan, 3, $alasan);
            $update_history = $this->Approval_m->add_history($idlaporan, 3, $alasan, 22, $idakun);
            $hasil = 1;
        }
        if ($hasil <= 0) {
            $this->session->set_flashdata('eror_input', 'eror_input');
            redirect('approvalsh'); // Redirect ke halaman riwayat laporan GL
        } else { // Update level persetujuan jika status disetujui oleh GL
            $this->session->set_flashdata('input', 'input');
            redirect('approvalsh'); // Redirect ke halaman riwayat laporan GL
        }
    }

    // method untuk mengupdate data level persetujuan pada SH
    public function setujuLevel2($id_permohonan) 
    {
        // Logika persetujuan Level 2 SH
        $this->Approval_m->updateLevelPersetujuan($id_permohonan, 3); // Set level persetujuan menjadi 3 (Laporan Disetujui)
        redirect('approvalsh'); // Redirect ke halaman berikutnya
    }
}