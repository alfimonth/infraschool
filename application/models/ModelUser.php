<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cekUser($nomor_induk)
  {
    $this->db->where('nomor_induk', $nomor_induk);
    return $this->db->get('user')->row_array();
  }
}
