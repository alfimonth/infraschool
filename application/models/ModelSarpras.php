<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelSarpras extends CI_Model
{
  public function getCategories($tipe)
  {
    $this->db->where('tipe', $tipe);
    return $this->db->get('kategori')->result_array();
  }

  public function add($data)
  {
    return $this->db->insert('kategori', $data);
  }
  public function edit($data, $id)
  {
    $this->db->where('id', $id);
    return $this->db->update('kategori', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('kategori');
  }
}
