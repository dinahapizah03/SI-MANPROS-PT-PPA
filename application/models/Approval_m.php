<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Approval_m extends CI_Model
{
    // untuk menambahkan data history laporan / detail laporan
    public function add_history($id_permohonan, $id_status_laporan, $alasan, $id_level_persetujuan, $idakun){
        $data['id_permohonan'] = $id_permohonan;
        $data['id_status_laporan'] = $id_status_laporan;
        $data['id_level_persetujuan'] = $id_level_persetujuan;
        $data['idakun'] = $idakun;
        $data['alasan'] = $alasan;
        $this->db->insert('history', $data);
        return true;
    }

    // untuk memanggil data approval / permohonan pada GL
    public function approval($iddepartemen)
    {   
    $this->db->select('permohonan.*, akun.nama, akun.NRP, departemen.divisi, st.status as status_kata');
    $this->db->from('permohonan');
    $this->db->join('akun', 'akun.idakun = permohonan.idakun');
    $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
    $this->db->join('status_laporan as st', 'st.id_status_laporan = permohonan.id_status_laporan');
    $this->db->where('permohonan.id_status_laporan', '1');
    $this->db->where('permohonan.iddepartemen', $iddepartemen);
    return $this->db->get()->result_array();
    }

    // untuk memanggil data approval / permohonan pada SH
    public function approval_sh($dept)
    {
        $this->db->select('permohonan.*, akun.nama, akun.nrp, departemen.divisi, st.status as status_kata' );
        // $this->db->select('*');
        $this->db->from('permohonan');
        $this->db->join('akun', 'akun.idakun = permohonan.idakun');
        $this->db->join('departemen', 'departemen.iddepartemen = permohonan.iddepartemen');
        $this->db->join('status_laporan as st', 'st.id_status_laporan = permohonan.id_status_laporan');
        $this->db->where('permohonan.id_status_laporan', '2');
        $this->db->where('permohonan.iddepartemen', $dept);
        return $this->db->get()->result_array(); // Execute the query and return results
    }

    //konfrmasi laporan atau validasi GL
     public function confirm_laporan_gl($id_permohonan, $id_status_laporan, $alasan)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE permohonan SET id_status_laporan='$id_status_laporan', alasan='$alasan' WHERE id_permohonan='$id_permohonan'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    //konfrmasi laporan atau validasi GL
    public function confirm_laporan_sh($id_permohonan, $id_status_laporan, $alasan)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE permohonan SET id_status_laporan='$id_status_laporan', alasan='$alasan' WHERE id_permohonan='$id_permohonan'");
        $this->db->trans_complete();
        if($this->db->trans_status()==true)
            return true;
        else
            return false;
    }

    public function updateLevelPersetujuan($id_permohonan, $permohonan)
    {
        $data = array(
            'level_persetujuan' => $permohonan,
            'level_persetujuan' => ($permohonan == 2) ? 'ya' : 'tidak' // Assuming the condition for 'disetujui_gl' is based on $laporan value
        );

        $this->db->where('id_permohonan', $id_permohonan);
        $this->db->update('permohonan', $data);
    }

//     public function insert_level_persetujuan($data)
// {
//     // Insert into 'disetujui_gl' table
//     $this->db->insert('level_persetujuan', $data);

//     // Check if the condition for GL approval button press is met
//     if ($id_status_laporan == 2) {
//         // Update 'disetujui_gl' attribute in 'laporan' table to 'ya'
//         $laporan_data = array(
//             'level_persetujuan' => '12'
//         );

//         $this->db->where('id_permohonan', $data['id_permohonan']);
//         $this->db->update('permohonan', $laporan_data);
//     }
//     else if ($id_status_laporan == 3) {
//         // Update 'disetujui_gl' attribute in 'laporan' table to 'ya'
//         $laporan_data = array(
//             'level_persetujuan' => '13'
//         );

//         $this->db->where('id_permohonan', $data['id_permohonan']);
//         $this->db->update('permohonan', $laporan_data);
//     }
// }

}