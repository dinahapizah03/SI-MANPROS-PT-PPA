<?php
defined('BASEPATH') or exit('No direct script access allowed');

//nama classnya
class Akun extends CI_Controller
{
    //pemanggilan construct 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form', 'download');
        $this->load->model('Akun_m');
        $this->load->model('Departemen_m');
    }
    //function tampilan awal
    public function index()
    {
        $data['akun'] = $this->Akun_m->akun()->result_array();
        $data['level'] = $this->Akun_m->get_all_level();
        $data['departemen'] = $this->Departemen_m->get_all_departemen();
        $level = $this->session->userdata('idlevel');
        if ($level == '10'){
            $this->load->view('master/components/header');
            $this->load->view('master/components/navbar');
            $this->load->view('master/akun', $data); 
            $this->load->view('master/components/sidebar'); 
            $this->load->view('master/components/password');
        }else {
            redirect('Auth/Error');
        }
    }
    //tampilan pada button tambah pada Akun
    public function tambah()
    {
        $NRP = $_POST['NRP'];
		$query = $this->db->get_where('akun', ['NRP' => $NRP]);
        $jum = $query->num_rows();
        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data Username Sudah Ada! Silahkan Coba Username Lain!!!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                </div>');
            redirect('akun');
        }
		if ($this->session->userdata('NRP') AND $this->session->userdata('idlevel')) {
            $NRP = $this->input->post("NRP");
            $password = password_hash($NRP, PASSWORD_DEFAULT);
            $nama = $this->input->post("nama");
            $idlevel = $this->input->post("idlevel");
            $iddepartemen = $this->input->post("iddepartemen");
            // upload image
            if($idlevel == '3' OR $idlevel == '9'){
                if($_FILES['ttd']['error'] == UPLOAD_ERR_OK){
                    $uploadDir = 'uploads/';
                    $uniqname = uniqid('img').'_'.time();
                    $original = pathinfo($_FILES['ttd']['name'], PATHINFO_EXTENSION);
                    $uploadFile = $uploadDir.$uniqname.'.'.$original;
                    if(move_uploaded_file($_FILES['ttd']['tmp_name'], $uploadFile)){
                        $hasil = $this->Akun_m->insert_akun(null, $NRP, $password, $nama, $idlevel, $iddepartemen, $uniqname);
                        $this->session->set_flashdata('input','input');
                        redirect('akun', $data);
                    } else {
                        $this->session->set_flashdata('eror','error');
                        redirect('akun', $data);
                    }
                } else {
                    $this->session->set_flashdata('eror','error');
                    redirect('akun', $data);
                }
            } else {
                $uniqname = '';
                $hasil = $this->Akun_m->insert_akun($id, $NRP, $password, $nama, $idlevel, $iddepartemen, $uniqname);
                $this->session->set_flashdata('input','input');
                redirect('akun', $data);
            }
     	}else{
			$this->session->set_flashdata('loggin_err','loggin_err');
			redirect('Auth');
		}        
    }

    // method untuk mengupload gambar ttd
    public function do_upload(){
        $file_name = date('Ymd-His');
        $config['file_name'] = $file_name;
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $this->load->library('upload', $config);
        if($this->upload->do_upload('ttd')){
            return 'berhasil upload';
        } else {
            return 'gagal upload';
        }
    }
    
    // method untuk mengedit data akun //                                                                          
     public function edit() {

    if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {

        $NRP = $this->input->post("NRP");
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $nama = $this->input->post("nama");
        $idlevel = $this->input->post("idlevel");
        $iddepartemen = $this->input->post("iddepartemen");
        $id = $this->input->post("idakun");
        
        $hasil = $this->Akun_m->update_akun($id, $NRP, $password, $nama, $idlevel, $iddepartemen);
        echo $hasil;
        if($hasil==false){
            $this->session->set_flashdata('eror_edit','eror_edit');
            redirect('akun', $data);
        }else{
            $this->session->set_flashdata('edit','edit');
            redirect('akun', $data);
        }
        }else{

        $this->session->set_flashdata('loggin_err','loggin_err');
        redirect('Auth');
    }         
}
    
    // -- method menghapus data produk -- //
    public function delete()
    {
        if ($this->session->userdata('NRP') == true AND $this->session->userdata('idlevel')) {
            $idakun = $this->input->post("idakun");
            
                $hasil = $this->Akun_m->delete_akun($idakun);
    
                if($hasil==false){
                    $this->session->set_flashdata('eror_hapus','eror_hapus');
                    redirect('akun', $data);
                }else{
                    $this->session->set_flashdata('hapus','hapus');
                    redirect('akun', $data);
                }
        }else{
    
            $this->session->set_flashdata('loggin_err','loggin_err');
            redirect('Auth');
        }       
    }

     // -- method change password -- //
    public function change_password()
    {
        $passwordbaru = $this->input->POST('passwordbaru');
        $konfirpassword = $this->input->POST('konfirpassword');
        $hashpwbaru = password_hash($passwordbaru, PASSWORD_DEFAULT);
        
        $passwordlama = $this->input->POST('passwordlama');
        $idakun = $this->session->userdata('idakun');
        $NRP = $this->session->userdata('NRP');
        $pengguna = $this->db->get_where('akun', ['NRP' => $NRP])->row_array();
        if ($passwordbaru == $konfirpassword) {
            if (password_verify($passwordlama, $pengguna['password'])){
                $process = $this->Akun_m->update_password($idakun, $hashpwbaru);
                if($process){
                    $this->session->set_flashdata('edit','edit');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('eror','eror');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('eror','eror');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // method reset password
    public function reset_password(){
        $idakun = $this->input->POST('idakun');
        $proses = $this->Akun_m->reset_password($idakun);
        if($proses > 0){
            $this->session->set_flashdata('edit','edit');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('eror','eror');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}