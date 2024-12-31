<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUtama extends CI_Model
{
    public function getData()
    {
        return $this->db->get('general_info')->result_array();
    }

    public function add($data)
    {
        return $this->db->insert('general_info', $data);
    }
    public function edit($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('general_info', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('general_info');
    }

    public function getTahunAjaran()
    {
        // Dapatkan timestamp saat ini
        $current_timestamp = time();  // Waktu sekarang dalam bentuk timestamp

        // Query untuk mencari tahun ajaran yang waktunya mencakup timestamp saat ini
        $this->db->where('started_at <=', date('Y-m-d H:i:s', $current_timestamp));  // started_at <= waktu sekarang
        $this->db->where('end_at >=', date('Y-m-d H:i:s', $current_timestamp));
        $this->db->limit(1);  // end_at >= waktu sekarang
        $query = $this->db->get('tahun_ajaran');  // Gantilah dengan nama tabel Anda

        // Cek jika data ditemukan
        if ($query->num_rows() > 0) {
            // Mengembalikan data tahun ajaran dalam bentuk row_array
            return $query->row_array()['nama'];
        } else {
            // Jika tidak ada tahun ajaran yang valid, kembalikan null
            return null;
        }
    }
}
