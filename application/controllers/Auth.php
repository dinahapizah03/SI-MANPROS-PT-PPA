<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // untuk pemanggilan construct
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_m');
    }

    // Fungsi yang digunakan untuk memanggil views untuk login
    public function index()
    {
        $nrp = $this->session->userdata('NRP');
        $idlevel = $this->session->userdata('idlevel');
        if($nrp AND $idlevel){
            if ($idlevel === '1') {
                redirect('Dashboardadm');
            } elseif ($idlevel === '9') {
                redirect('Dashboard');
            } elseif ($idlevel === '3') {
                redirect('Dashboardsh');
            } elseif ($idlevel === '10') {
                redirect('Dashboardms');
            } else {
                redirect('Auth');
            }
        } else {
            $data['title'] = 'Sign In';
            $this->load->view('login', $data);
        }
    }

    // Fungsi yang digunakan untuk proses masuk sesi (login)
    public function login_processed()
    {
        // fungsi ini bersifat privasi, agar tidak bisa di akses di url, hanya di fungsi yang memanggil saja
        $NRP = $this->input->post('NRP');
        $password = $this->input->post('password');
        //Mencari di databse
        //fungsi row_array agar tidak semua record terpanggil, hanya record yang di tentukan saja
        $pengguna = $this->db->get_where('akun', ['NRP' => $NRP])->row_array();

        // Cek kata password
        if ($pengguna) {
            if (password_verify($password, $pengguna['password'])) {
                //jika surel benar dan dan password benar
                $data = [
                    'NRP' => $pengguna['NRP'],
                    'idlevel' => $pengguna['idlevel'],
                    'nama' => $pengguna['nama'],
                    'idakun' => $pengguna['idakun'],
                    'iddepartemen' => $pengguna['iddepartemen'],
                ];
                $this->session->set_userdata($data);
                $this->session->set_userdata('idlevel', $pengguna['idlevel']);
                if ($pengguna) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Berhasil Login</div>');
                    if ($pengguna['idlevel'] === '1') {
                        redirect('Dashboardadm');
                    } elseif ($pengguna['idlevel'] === '9') {
                        redirect('Dashboard');
                    } elseif ($pengguna['idlevel'] === '3') {
                        redirect('Dashboardsh');
                    } elseif ($pengguna['idlevel'] === '10') {
                        redirect('Dashboardms');
                    } else {
                        redirect('Auth');
                    }
                } else {
                    $this->session->unset_userdata('NRP');
                    $this->session->unset_userdata('idlevel');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun kamu belum aktif, tunggu admin mengaktifkan</div>');
                    redirect('Auth');
                }
            } else {
                //jika password salah, tapi alamat surel ditemukan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, password yang kamu masukkan salah</div>');
                redirect('Auth');
            }
        } else { //jika penguna tidak di temukan
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">pengguna tidak di temukan...</div>');
            redirect('Auth');
        }
    }
    // untuk menjelankan fungsi logout
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('idlevel');
        $this->session->set_flashdata('success_logout','success_logout');
        redirect('Auth');
    }

    // method untuk menammpilkan tampilan error 404 / validation
    public function error()
    {   
        $this->load->view('Error'); 
    }
}