<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen_m extends CI_Model
{

    // untuk mengambil data departemen
    public function departemen()
    {
        $hasil = $this->db->query('SELECT * FROM departemen 
        WHERE departemen.iddepartemen');
        return $hasil;
    }

    // untuk mengambil semua data departemen
    public function get_all_departemen()
    {
        $this->db->select('iddepartemen, namadepartemen, divisi');
        $query = $this->db->get('departemen');

        if ($query->num_rows() > 0) {
            return $query->result_array(); // Return department data
        } else {
            return null; // Return empty array if no department data found
        }
    }

    // untuk menambahkan data departemen
    public function pendaftaran_departemen($id, $namadepartemen, $divisi)
    {
        $this->db->trans_start();
        $this->db->query("INSERT INTO departemen(iddepartemen,namadepartemen,divisi) VALUES ('$id','$namadepartemen','$divisi')");
        $this->db->trans_complete();
         if($this->db->trans_status()==true)
             return true;
         else
             return false;
    }

    // untuk mengupdate data departemen
    public function update_departemen($id, $namadepartemen, $divisi)
    {
       $this->db->trans_start();
       $this->db->query("UPDATE departemen SET namadepartemen='$namadepartemen', divisi='$divisi' WHERE iddepartemen='$id'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    // untuk menghapus data departemen
    public function delete_departemen($id)
    {
       $this->db->trans_start();
       $this->db->query("DELETE FROM departemen WHERE iddepartemen='$id'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }
}