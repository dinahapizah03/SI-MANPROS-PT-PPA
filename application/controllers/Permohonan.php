<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {

    // method pemanggilan construct
    public function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form', 'download');
        $this->load->model('Permohonan_m');
    }

    // method untuk semua tampilan yang ada pada halaman proposal|
    public function index() {
        // untuk mendefiniskan bulan pada kode surat dengan romawi
        function getMonth($param) {
            if ($param == '01') {
                return 'I';
            } else if ($param == '02') {
                return 'II';
            } else if ($param == '03') {
                return 'III';
            } else if ($param == '04') {
                return 'IV';
            } else if ($param == '05') {
                return 'V';
            } else if ($param == '06') {
                return 'VI';
            } else if ($param == '07') {
                return 'VII';
            } else if ($param == '08') {
                return 'VIII';
            } else if ($param == '09') {
                return 'IX';
            } else if ($param == '10') {
                return 'X';
            } else if ($param == '11') {
                return 'XI';
            } else if ($param == '12') {
                return 'XII';
            }
        }
        $data['permohonan'] = $this->Permohonan_m->permohonan();
        $nrp = $this->session->userdata('NRP');
        $data['nrp'] = $nrp;
        $data['list_item'] = $this->Permohonan_m->get_semua_barang();
        $data['last'] = $this->Permohonan_m->get_last_permohonan();
        $data['month'] = getMonth(date("m"));
        $data['year'] = date("Y");
        $level = $this->session->userdata('idlevel');
        if ($level == '1'){
            $this->load->view('admin/components/header');
            $this->load->view('admin/components/navbar');
            $this->load->view('admin/permohonan', $data);
            $this->load->view('admin/components/sidebar'); 
        }else {
            redirect('Auth/Error');
        }
    }

    // method untuk mengecek data departemen pada akun
    public function check(){
        $idakun = 1;
        echo $this->Permohonan_m->get_id_dept($idakun)->iddepartemen;
    }

    // method untuk mengeksekusi button tambah
    public function tambah(){
        $data['id_permohonan'] = $this->input->post('id_permohonan');
        $data['no_surat'] = $this->input->post('no_surat');
        $idakun = $this->input->post('idakun');
        $data['idakun'] = $this->session->userdata('idakun');
        $data['created_date'] = null;
        $data['catatan'] = $this->input->post('catatan');
        $data['iddepartemen'] = $this->Permohonan_m->get_id_dept($idakun)->iddepartemen;
        $data['id_status_laporan'] = $this->input->post('id_status_laporan');
        $data['alasan'] = $this->input->post('alasan');
        $insert_permohonan = $this->Permohonan_m->insert_new_permohonan($data);
        $daftar_item = $this->input->post('daftar_item');
        foreach ($daftar_item as &$value){
            $value['id_permohonan'] = $insert_permohonan; 
        }
        // adding list item
        $insert_item = $this->Permohonan_m->insert_list_item($daftar_item);
        echo $insert_item;
    }

    // method untuk mengupdate data permohonan
    public function update_permohonan(){
        $idpermohonan = $this->input->post('idpermohonan');
        $catatan = $this->input->post('catatan');
        $update_permohonan = $this->Permohonan_m->update_permohonan($idpermohonan, $catatan);
        $delete_item = $this->Permohonan_m->delete_list_item($idpermohonan);
        $listitem = $this->input->post('listitem');
        echo print_r($listitem);
        foreach ($listitem as &$value){
            $value['id_permohonan'] = $idpermohonan; 
        }
        // adding list item
        $insert_item = $this->Permohonan_m->insert_list_item($listitem);
        echo $insert_item;
    }

    // method untuk menampilkan pesan success
    public function success_message(){
        $this->session->set_flashdata('input','input');
        redirect('permohonan');
    }
    
    public function edit(){
        $id_permohonan = $this->input->post('id_permohonan');
        $catatan = $this->input->post('catatan');
        $edit = $this->Permohonan_m->update_permohonan($id, $catatan);
        $deleteitem = $this->Permohonan_m->delete_list_item($id);
        // adding list item
        $daftar_item = $this->input->post('daftar_item');
        foreach ($daftar_item as &$value){
            $value['id_permohonan'] = $id; 
        }
        $insert_item = $this->Permohonan_m->insert_list_item($daftar_item);
        echo $insert_item;
    }
    
    // method untuk menghapus data permohonan dan list item
    public function delete()
    {
        if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {
            $id_permohonan = $this->input->post("id_permohonan");
            
                $hasil = $this->Permohonan_m->delete_permohonan($id_permohonan);
                $hasilitem = $this->Permohonan_m->delete_barang($id_permohonan, 'permohonan');
    
                if($hasil == false || $hasilitem == false){
                    $this->session->set_flashdata('eror_hapus','eror_hapus');
                    redirect('permohonan', $data);
                }else{
                    $this->session->set_flashdata('hapus','hapus');
                    redirect('permohonan', $data);
                }
    
        }else{
    
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Auth');
    
        }
    }

    // method untuk mengambil data list item
    public function get_list_item() 
    {
        $id_item = $this->uri->segment('3');
        $result = $this->Permohonan_m->get_list_item($id_item);
        echo json_encode($result);
    }
    
    // untuk mengambil data history untuk halaman laporan
    public function get_det_permohonan(){
        $id = $this->uri->segment('3');
        $data = $this->Permohonan_m->get_det_permohonan($id);
        echo json_encode($data);
    }
}
