<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanms extends CI_Controller
{
    // method untuk pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'download');
        $this->load->model('Laporan_m');
        $this->load->model('Permohonan_m');
    }
    // method untuk tampilan laporan
    public function index()
    {   
        $data['laporan'] = $this->Laporan_m->laporan();
        $level = $this->session->userdata('idlevel');
        if ($level == '10'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar'); 
            $this->load->view('master/laporanms', $data); 
            $this->load->view('master/components/sidebar');
            $this->load->view('master/components/password');
        }else {
            redirect('Auth/Error');
        }
    }
    // method untuk tampilan laporan GL
    public function group_leader()
    {   
        $data['laporan'] = $this->Laporan_m->laporan();
        $level = $this->session->userdata('idlevel');
        if ($level == '9'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar'); 
            $this->load->view('master/laporanms', $data); 
            $this->load->view('groupleader/components/sidebar');
        }else {
            redirect('Auth/Error');
        }
    }
    // method untuk tampilan laporan SH
    public function section_head()
    {   
        $data['laporan'] = $this->Laporan_m->laporan();
        $level = $this->session->userdata('idlevel');
        if ($level == '3'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar'); 
            $this->load->view('master/laporanms', $data); 
            $this->load->view('sectionhead/components/sidebar');
        }else {
            redirect('Auth/Error');
        }
    }
    // method untuk tampilan melihat detail laporan 
    public function view_history()
    {   
        $user= $this->session->userdata('idlevel');
        $id_permohonan= $this->uri->segment('3');
        $data['history_laporan'] = $this->Laporan_m->get_history($id_permohonan);
        $level = $this->session->userdata('idlevel');
        if ($level == '10' OR $level == '9' OR $level == '3'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar'); 
            $this->load->view('master/history', $data);
            if($user == '10'){
                $this->load->view('master/components/sidebar');
            } else if($user == '9'){
                $this->load->view('groupleader/components/sidebar');
            } else if($user == '3'){
                $this->load->view('sectionhead/components/sidebar');
            }
        }else {
            redirect('Auth/Error');
        }
    }
    // method untuk mengambil data history
    public function view_data(){
        echo json_encode($this->Laporan_m->get_history(22));
    }

     // method untuk memprint surat
     function print_surat($id)
     {
         $this->load->library('pdfgenerator');
         
         $data['title'] = "Laporan RKB";
         $file_pdf = $data['title'];
         $paper = 'A4';
         $orientation = "portrait";
         
         // Ambil data dari model Permohonan_model
         $data['permohonan'] = $this->Permohonan_m->get_data_by_id('permohonan', $id)->row();        
         $data['list_item'] = $this->Permohonan_m->get_data_by_id('list_item', $id)->result();
         $data['ttd_sh'] = $this->Permohonan_m->get_ttd('ttd','section head', $id);
         $data['ttd_gl'] = $this->Permohonan_m->get_ttd('ttd', 'group leader', $id);
         $data['nama_sh'] = $this->Permohonan_m->get_ttd('nama', 'section head', $id);
         $data['nama_gl'] = $this->Permohonan_m->get_ttd('nama', 'group leader', $id);
         // Mengambil data list_item secara langsung
         $data['akun'] = $this->Permohonan_m->get_data_akun('akun', $id)->row();
         
         $html = $this->load->view('sectionhead/laporanpdf', $data, true);
         $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
     }

}