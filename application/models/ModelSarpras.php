<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelSarpras extends CI_Model
{
  // Kategori
  public function add($data)
  {
    if ($this->db->insert('kategori', $data)) {
      // Mengembalikan ID dari data yang baru saja dimasukkan
      return $this->db->insert_id();
    } else {
      return false; // Gagal insert
    }
  }
  public function getCategories($tipe)
  {
    $this->db->where('tipe', $tipe);
    return $this->db->get('kategori')->result_array();
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

  // Ruangan
  public function addRoom($data)
  {
    return $this->db->insert('ruang', $data);
  }
  public function getRooms()
  {
    return $this->db->get('ruang')->result_array();
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

  // Peralatan

  public function addTool($data)
  {
    return $this->db->insert('peralatan', $data);
  }

  public function getTools()
  {
    return $this->db->get('peralatan')->result_array();
  }

  public function editTool($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('peralatan', $data);
  }

  public function deleteTool($id)
  {
    $res = $this->db->select('image')->where('id', $id)->get('peralatan')->row_array();
    $image_path = './public/uploads/sarpras/peralatan/' . $res['image'];
    if (file_exists($image_path)) {
      unlink($image_path);
    }
    $this->db->where('id', $id);
    return $this->db->delete('peralatan');
  }
}
