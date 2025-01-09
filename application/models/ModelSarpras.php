<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelSarpras extends CI_Model
{
  public function getRooms()
  {
    return $this->db->get('ruang')->result_array();
  }
  public function getCategories($tipe)
  {
    $this->db->where('tipe', $tipe);
    return $this->db->get('kategori')->result_array();
  }

  public function add($data)
  {
    return $this->db->insert('kategori', $data);
  }
  public function addRoom($data)
  {
    return $this->db->insert('ruang', $data);
  }

  public function editRoom($data, $id)
  {
    
    $this->db->where('id', $id);
    return $this->db->update('ruang', $data);
  }

  public function deleteRoom($id)
  {
    $res = $this->db->select('image')->where('id', $id)->get('ruang')->row_array();
    $image_path = './public/uploads/sarpras/ruang/' . $res['image'];
    if (file_exists($image_path)) {
      unlink($image_path);
    }
    $this->db->where('id', $id);
    return $this->db->delete('ruang');
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
