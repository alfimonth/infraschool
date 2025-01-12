<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllAdminUser()
  {
    $this->db->where('role', 'admin');
    return $this->db->get('user')->result_array();
  }

  public function getAllAnggotaUser($filter = null)
  {

    $this->db->where('role', 'anggota');
    if ($filter != null) {
      $this->db->where('status', $filter);
    }
    return $this->db->get('user')->result_array();
  }

  public function cekUser($nomor_induk)
  {
    $this->db->where('nomor_induk', $nomor_induk);
    return $this->db->get('user')->row_array();
  }

  public function add($data)
  {
    return $this->db->insert('user', $data);
  }

  public function edit($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('user', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('user');
  }

  public function add_batch($data)
  {

    $inserted = 0; // Counter data yang berhasil ditambahkan
    $skipped = 0;  // Counter data yang dilewati

    foreach ($data as $row) {
      $nomor_induk = $row['nomor_induk'];

      // Cek apakah nomor_induk sudah ada di database
      $existing = $this->db->get_where('user', ['nomor_induk' => $nomor_induk])->row_array();
      if ($existing) {
        $skipped++;
        continue; // Jika sudah ada, lewati
      }

      // Jika tidak ada, tambahkan ke database
      $this->db->insert('user', $row);
      $inserted++;
    }

    return [
      'inserted' => $inserted,
      'skipped' => $skipped,
    ];
  }
}
