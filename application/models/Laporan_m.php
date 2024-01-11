<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    public function laporan($dept)
    {
        $this->db->select('permohonan.*, akun.nama, akun.nrp, departemen.divisi' );
        $this->db->from('permohonan');
        $this->db->join('akun', 'akun.idakun = permohonan.idakun');
        $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->result_array(); // Execute the query and return results
    }
    
    public function history_laporan()
    {
        $this->db->select('permohonan.*, list_item.agenda, st.status as status_kata' );
        $this->db->from('permohonan');
        $this->db->join('list_item', 'list_item.id_permohonan = permohonan.id_permohonan');
        $this->db->join('akun', 'list_item.id_permohonan = permohonan.id_permohonan');
        $this->db->join('status_laporan as st', 'st.id_status_laporan = permohonan.status');
        $this->db->where_not_in('permohonan.id_status_laporan', 1);
        return $this->db->get()->result_array(); // Execute the query and return results
    }

    public function get_data_riwayat($table)
    {
        $this->db->select('*');
        $this->db->from('laporan');
        $this->db->where_not_in('id_status_laporan', 1);
        return $this->db->get('');
    }

    public function get_history($id){
        $this->db->select('*');
        $this->db->from('history');
        $this->db->join('akun', 'akun.idakun = history.idakun');
        $this->db->where('id_permohonan', $id);
        return $this->db->get()->result_array();
    }

    // untuk menampilkan semua riwayat laporan
    public function dapatkanRiwayatSemuaLaporan() {
        $this->db->select('riwayat.*, laporan.idlaporan');
        $this->db->from('riwayat');
        $this->db->join('laporan', 'riwayat.idlaporan = idlaporan', 'left');
        $this->db->order_by('riwayat.created_at', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    //mendapatkan data sebuah surat sesuai id
    public function get_where($id)
    {
        $query = $this->db->get_where('laporan', ['idlaporan' => $id])->row_array();
        return $query;
    }

    public function detail_persetujuan($idlaporan) //getdata detail transaksi 
    {
        return $this->db->get_where('tlaporan', ['idlaporan' => $idlaporan])->result_array();
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