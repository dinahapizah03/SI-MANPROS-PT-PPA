<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_m extends CI_Model {
    // untuk menampilkan data permohonan
    public function permohonan()
    {
        $this->db->select('permohonan.*, akun.nama, departemen.divisi, st.status as status_kata' );
        $this->db->from('permohonan');
        $this->db->join('akun', 'akun.idakun = permohonan.idakun');
        $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
        $this->db->join('status_laporan as st', 'st.id_status_laporan = permohonan.id_status_laporan');
        return $this->db->get()->result_array(); // Execute the query and return results
    }

    // untuk mengambil gambar ttd
     public function get_ttd($type, $id){
        $this->db->select('akun.ttd, akun.nama');
        $this->db->from('history');
        $this->db->join('akun', 'akun.idakun = history.idakun');
        $this->db->where('history.id_permohonan', $id);
        if($type == 'group leader'){
            $this->db->where('history.id_level_persetujuan', 12);
        } else if($type == 'section head'){
            $this->db->where('history.id_level_persetujuan', 21);
        };
        return $this->db->get()->row();
     }

     // untuk mengambil data departemen
     public function get_id_dept($idakun){
        $this->db->select('akun.*');
        $this->db->from('akun');
        $this->db->where('akun.idakun', $idakun);
        return $this->db->get()->row();
     }

     // untuk mengambil data permohonan dan list item berdassarkan id
     public function get_data_by_id($table, $id) 
     {
        if($table == 'permohonan'){
            $this->db->select('permohonan.*, akun.NRP, departemen.divisi');
            $this->db->from('permohonan');
            $this->db->join('akun', 'akun.idakun = permohonan.idakun');
            $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
            $this->db->where('permohonan.id_permohonan', $id);
        } else if($table == 'list_item'){
            $this->db->select('*');
            $this->db->from('list_item');
            $this->db->where('id_permohonan', $id);
        }
        // $this->db->query('SELECT la.*, ak.* FROM permohonan la left join akun ak on la.nrp = ak.NRP where la.id = 1');
        return $this->db->get();
     }

     // untuk mengambil data akun
    public function get_data_akun($table, $id) {
        $this->db->select('akun.*');
        $this->db->where('idakun', $id);
        // return $this->db->get($table);
        return $this->db->get($table);
    }

    // untuk mengambil data permohonan terakhir
     public function get_last_permohonan(){
        $this->db->select('id_permohonan');
        $this->db->from('permohonan');
        $this->db->order_by('id_permohonan', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();   
    }

    // untuk mengupdate data permohonan
    public function update_permohonan($id, $catatan){
        $this->db->set('catatan', $catatan);
        $this->db->where('id_permohonan', $id);
        return $this->db->update('permohonan');
    }

    // untuk menghapus data list item
    public function delete_list_item($id){
        $this->db->where('id_permohonan', $id);
        return $this->db->delete('list_item');
    }

    // untuk mengambil semua data barang / list item
    public function get_semua_barang() {
        $hasil = $this->db->query('SELECT * FROM list_item 
        WHERE list_item.id_item');
        return $hasil->result();
    }

    // untuk menggambil data list item
    public function get_list_item($id_item) {
        $this->db->select('permohonan.*, list_item.*' );
        $this->db->from('permohonan');
        $this->db->join('list_item', 'list_item.id_permohonan = permohonan.id_permohonan');
        $this->db->where('permohonan.id_permohonan', $id_item);
        // $query = $this->db->get('list_item');
        return $this->db->get()->result_array();
    }

    // untuk menambahkan data list item
    public function insert_list_item($data){
        $query = $this->db->insert_batch('list_item', $data);
        return $query;
    }

    // untuk menambahkan data permohonan
    public function insert_new_permohonan($data){
        $this->db->insert('permohonan', $data);
        return $this->db->insert_id();
    }

    // untuk menghapus data barang
    public function delete_barang($id, $type) {

        $this->db->trans_start();
        if($type == 'id'){
            $this->db->query("DELETE FROM list_item WHERE id_item='$id'");
        } else if($type == 'permohonan'){
            $this->db->query("DELETE FROM list_item WHERE id_permohonan='$id'");
        }
       
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    // untuk menghapus data permohonan
    public function delete_permohonan($id)
    {
       $this->db->trans_start();
       $this->db->query("DELETE FROM permohonan WHERE id_permohonan='$id'");
       $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    // untuk mengambil data departemen pada tabel permohonan
    public function get_det_permohonan($id){
        $this->db->select('*');
        $this->db->from('permohonan');
        $this->db->join('list_item', 'permohonan.id_permohonan = list_item.id_permohonan');
        $this->db->where('permohonan.id_permohonan', $id);
        return $this->db->get()->result_array();
    }   
}
