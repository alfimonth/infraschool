<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelSarpras extends CI_Model
{
  public function getDetailedCategories($type, $filter = null)
  {
    if ($type == 'Ruang') {
      $this->db->select('k.id as kategori_id, k.nama as kategori_nama, ruang.*');
      $this->db->from('kategori k');
      $this->db->join('ruang', 'ruang.id_kategori = k.id', 'left');
      if ($filter) {
        $this->db->where('ruang.created_at <=', $filter);
      }
      $this->db->where('k.tipe', $type);
      $query = $this->db->get();
      return $query->result_array();
    }

    if ($type == 'Peralatan') {
      $this->db->select('k.id as kategori_id, k.nama as kategori_nama, peralatan.*');
      $this->db->from('kategori k');
      $this->db->join('peralatan', 'peralatan.id_kategori = k.id', 'left');
      if ($filter) {
        $this->db->where('peralatan.created_at <=', $filter);
      }
      $this->db->where('k.tipe', $type);
      $query = $this->db->get();
      return $query->result_array();
    }

    return [];
  }


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
    $this->db->from('kategori')->where('tipe', $tipe);
    if ($tipe == 'Ruang') {
      $this->db->select('kategori.*, COUNT(ruang.id) as jumlah');
      $this->db->join('ruang', 'ruang.id_kategori = kategori.id', 'left');
      $this->db->group_by('kategori.id'); // Tambahkan GROUP BY
    }
    if ($tipe == 'Peralatan') {
      $this->db->select('kategori.*, COUNT(peralatan.id) as jumlah');
      $this->db->join('peralatan', 'peralatan.id_kategori = kategori.id', 'left');
      $this->db->group_by('kategori.id'); // Tambahkan GROUP BY
    }

    if ($tipe == 'subPeralatan') {
      $this->db->select('kategori.*, COUNT(peralatan.id) as jumlah');
      $this->db->join('peralatan', 'peralatan.id_subkategori = kategori.id', 'left');
      $this->db->group_by('kategori.id'); // Tambahkan GROUP BY
    }
    return $this->db->get()->result_array();
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
    $this->db->insert('ruang', $data);
    return $this->db->insert_id(); // Mengembalikan ID ruang yang baru saja dimasukkan
  }
  public function getRooms($filter = null)
  {
    if ($filter === "home") {
      $this->db->where('baik >', 0);
    }
    $this->db->where('ruang.deleted_at', null);
    return $this->db->get('ruang')->result_array();
  }

  public function getRoom($id)
  {
    $this->db->select('ruang.*, kategori.nama as kategori');
    $this->db->from('ruang');
    $this->db->join('kategori', 'kategori.id = ruang.id_kategori', 'left'); // Join tabel kategori
    $this->db->where('ruang.id', $id);
    $this->db->where('ruang.deleted_at', null);
    return $this->db->get()->row_array();
  }


  public function editRoom($data, $id)
  {

    $this->db->where('id', $id);
    return $this->db->update('ruang', $data);
  }

  public function deleteRoom($id)
  {
    // $res = $this->db->select('image')->where('id', $id)->get('ruang')->row_array();
    // $image_path = './public/uploads/sarpras/ruang/' . $res['image'];
    // if (file_exists($image_path)) {
    //   unlink($image_path);
    // }
    // $this->db->where('id', $id);
    // return $this->db->delete('ruang');
    // Ambil data image terlebih dahulu
    $res = $this->db->select('image')->where('id', $id)->get('ruang')->row_array();

    if ($res) {
      // Update field `deleted_at` dengan timestamp saat ini
      $data = ['deleted_at' => date('Y-m-d H:i:s')];
      $this->db->where('id', $id);
      return $this->db->update('ruang', $data);
    }

    return false;
  }

  // Peralatan

  public function addTool($data)
  {
    $this->db->insert('peralatan', $data);
    return $this->db->insert_id();
  }

  public function getTools($filter = null)
  {
    if ($filter === "home") {
      $this->db->where('baik >', 0);
    }
    $this->db->where('peralatan.deleted_at', null);
    return $this->db->get('peralatan')->result_array();
  }

  public function getTool($id)
  {
    $this->db->select('
        peralatan.*, 
        kategori.nama as kategori, 
        subkategori.nama as subkategori
    ');
    $this->db->from('peralatan');
    $this->db->where('peralatan.deleted_at', null);
    $this->db->join('kategori as kategori', 'kategori.id = peralatan.id_kategori', 'left'); // Join kategori
    $this->db->join('kategori as subkategori', 'subkategori.id = peralatan.id_subkategori', 'left'); // Join sub_kategori
    $this->db->where('peralatan.id', $id);
    return $this->db->get()->row_array();
  }



  public function editTool($id, $data)
  {
    $this->db->where('id', $id);
    return $this->db->update('peralatan', $data);
  }

  public function deleteTool($id)
  {
    // $res = $this->db->select('image')->where('id', $id)->get('peralatan')->row_array();
    // $image_path = './public/uploads/sarpras/peralatan/' . $res['image'];
    // if (file_exists($image_path)) {
    //   unlink($image_path);
    // }
    // $this->db->where('id', $id);
    // return $this->db->delete('peralatan');
    $res = $this->db->select('image')->where('id', $id)->get('peralatan')->row_array();

    if ($res) {
      // Update field `deleted_at` dengan timestamp saat ini
      $data = ['deleted_at' => date('Y-m-d H:i:s')];
      $this->db->where('id', $id);
      return $this->db->update('peralatan', $data);
    }

    return false;
  }


  public function updateStok($id, $tabel, $data)
  {
    foreach ($data as $key => $value) {
      $this->db->set($key, "$key + $value", FALSE); // Menambahkan nilai baru ke kolom yang ada
    }
    $this->db->where('id', $id);
    return $this->db->update(strtolower($tabel));
  }
}
