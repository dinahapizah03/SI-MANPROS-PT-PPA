<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_m extends CI_Model
{
    // fungsi untuk mengambil semua data level
    public function get_all_level()
    {
        $this->db->select('idlevel, level_k');
        $query = $this->db->get('level');

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return level data
        } else {
            return array(); // Return empty array if no level data found
        }
    }

    // untuk menambahkan data akun
    public function insert_akun($id, $NRP, $password, $nama, $idlevel, $iddepartemen, $ttd)
    {
       $this->db->trans_start();
       $this->db->query("INSERT INTO akun(idakun,NRP,password,nama,idlevel, iddepartemen, ttd) VALUES ('$id','$NRP','$password','$nama','$idlevel','$iddepartemen', '$ttd')");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
    
    // untuk menampilkan data akun
    public function akun()
    {   
        $hasil = $this->db->query('SELECT * FROM akun JOIN level ON akun.idlevel = level.idlevel 
        JOIN departemen ON akun.iddepartemen = departemen.iddepartemen 
        WHERE akun.idlevel ORDER BY akun.NRP ASC');
        return $hasil;
    }

    // untuk mengupdate data akun
    public function update_akun($id, $NRP, $password, $nama, $idlevel, $iddepartemen)
    {
       $this->db->trans_start();
       $this->db->query("UPDATE akun SET NRP='$NRP', password='$password', nama='$nama', idlevel='$idlevel', iddepartemen='$iddepartemen' WHERE idakun='$id'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    // untuk menghapus data akun
    public function delete_akun($id)
    {
       $this->db->trans_start();
       $this->db->query("DELETE FROM akun WHERE idakun='$id'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }   
    
    // untuk mengupdate password pada akun karyawan
    public function update_password($where, $data)
    {
        $this->db->where($where);
        return $this->db->update('akun', $data);
    }
}