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
}
