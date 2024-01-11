<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen extends CI_Controller
{
    // method untuk pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Departemen_m');
        
    }

    // method untuk tampilan departemen
    public function index()
    {
        $data['departemen'] = $this->Departemen_m->departemen()->result_array();
        $level = $this->session->userdata('idlevel');
        if ($level == '10'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar');
            $this->load->view('master/departemen', $data); 
            $this->load->view('master/components/sidebar'); 
            $this->load->view('master/components/password');
        }else {
            redirect('Auth/Error');
        }
    }

    //proses penambahan data departemen
    public function tambah()
    {
        if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {

            $namadepartemen = $this->input->post('namadepartemen');
            $divisi = $this->input->post('divisi');
            
                $hasil = $this->Departemen_m->pendaftaran_departemen($id, $namadepartemen, $divisi);
    
                if($hasil==false){
                    $this->session->set_flashdata('eror','eror');
                    redirect('departemen', $data);
                }else{
                    $this->session->set_flashdata('input','input');
                    redirect('departemen', $data);
                }
    
        }else{
    
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Auth');
        }  
    }

    // method untuk edit data departemen
    public function edit()
    {
        if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {
    
            $namadepartemen = $this->input->post('namadepartemen');
            $divisi = $this->input->post('divisi');
            $id = $this->input->post("iddepartemen");
            
            $hasil = $this->Departemen_m->update_departemen($id, $namadepartemen, $divisi);
            echo $hasil;
                if($hasil==false){
                    $this->session->set_flashdata('eror','eror');
                    redirect('departemen', $data);
                }else{
                    $this->session->set_flashdata('input','input');
                    redirect('departemen', $data);
                }
    
        }else{
    
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Auth');
        }
    }

    // method untuk hapus data departemen
    public function delete()
    {
        if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {
            $iddepartemen = $this->input->post("iddepartemen");
            
                $hasil = $this->Departemen_m->delete_departemen($iddepartemen);
    
                if($hasil==false){
                    $this->session->set_flashdata('eror_hapus','eror_hapus');
                    redirect('departemen', $data);
                }else{
                    $this->session->set_flashdata('hapus','hapus');
                    redirect('departemen', $data);
                }
    
        }else{
    
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Auth');
    
        } 
    }
}
