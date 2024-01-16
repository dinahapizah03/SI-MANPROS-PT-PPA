<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    // menampilkan data laporan
    public function laporan($dept)
    {
        $this->db->select('permohonan.*, akun.nama, akun.nrp, departemen.divisi' );
        $this->db->from('permohonan');
        $this->db->join('akun', 'akun.idakun = permohonan.idakun');
        $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->result_array(); // Execute the query and return results
    }
    
     // untuk mengambil data history
     public function get_history($id){
        $this->db->select('*');
        $this->db->from('history');
        $this->db->join('akun', 'akun.idakun = history.idakun');
        $this->db->where('id_permohonan', $id);
        return $this->db->get()->result_array();
    }
    
    //menghitung status disetujui
    public function count_statusdisetujui($dept)
    {
        $this->db->from('permohonan');
        $this->db->where('id_status_laporan', '2');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->num_rows();
    }
    //menghitung status complete
    public function count_statuscomplete($dept)
    {
        $this->db->from('permohonan');
        $this->db->where('id_status_laporan', '4');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->num_rows();
    }
    //menghitung status ditolak
    public function count_statusditolak($dept)
    {
        $this->db->from('permohonan');
        $this->db->where('id_status_laporan', '3');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->num_rows();
    }
}