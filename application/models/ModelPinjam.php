<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModelPinjam extends CI_Model
{
  public function getDraft()
  {
    $user = getProfile('id');
    $this->db->where('id_user', $user);
    $this->db->where('status', 'draft');
    $res = $this->db->get('pinjam')->row_array();

    return $res !== null ?
      $res :
      $this->newDraft();
  }

  public function getlist($draft)
  {
    // Ambil data untuk tipe 'Ruang'
    $this->db->select('detail_pinjam.*, ruang.jenis as nama_sarpras, (ruang.baik - ruang.dipinjam) as stok');
    $this->db->from('detail_pinjam');
    $this->db->join('ruang', 'ruang.id = detail_pinjam.id_sarpras', 'left');
    $this->db->where('id_pinjam', $draft);
    $this->db->where('tipe', 'Ruang');
    $queryRuang = $this->db->get()->result_array();

    // Ambil data untuk tipe 'Peralatan'
    $this->db->select('detail_pinjam.*, peralatan.jenis as nama_sarpras, (peralatan.baik - peralatan.dipinjam) as stok');
    $this->db->from('detail_pinjam');
    $this->db->join('peralatan', 'peralatan.id = detail_pinjam.id_sarpras', 'left');
    $this->db->where('id_pinjam', $draft);
    $this->db->where('tipe', 'Peralatan');
    $queryPeralatan = $this->db->get()->result_array();

    $result = array_merge($queryRuang, $queryPeralatan);
    return $result;
  }

  public function newDraft()
  {
    $user = getProfile('id');
    $data = [
      'id_user' => $user,
      'status' => 'draft'
    ];
    $this->db->insert('pinjam', $data);
    return $this->getDraft();
  }

  public function addToList($data)
  {

    return $this->db->insert('detail_pinjam', $data);
  }

  public function updateList($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('detail_pinjam', $data);
  }

  public function deleteList($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('detail_pinjam');
  }

  public function ajukan($id, $data)
  {
    // 1. Update status pinjaman menjadi "diajukan" dan set tanggal pinjam

    $this->db->where('id', $id);
    $this->db->update('pinjam', $data);

    // 2. Ambil list detail pinjam berdasarkan ID pinjam
    $this->db->select('*');
    $this->db->from('detail_pinjam');
    $this->db->where('id_pinjam', $id);
    $query = $this->db->get();
    $detailPinjam = $query->result_array();

    // 3. Update jumlah yang dipinjam pada tabel ruang atau peralatan sesuai dengan tipe
    foreach ($detailPinjam as $item) {
      if ($item['tipe'] == 'Ruang') {
        // Jika tipe ruang, update jumlah dipinjam pada tabel ruang
        $this->db->set('dipinjam', 'dipinjam + ' . $item['jumlah'], false); // Increment jumlah dipinjam
        $this->db->where('id', $item['id_sarpras']);
        $this->db->update('ruang');
      } elseif ($item['tipe'] == 'Peralatan') {
        // Jika tipe peralatan, update jumlah dipinjam pada tabel peralatan
        $this->db->set('dipinjam', 'dipinjam + ' . $item['jumlah'], false); // Increment jumlah dipinjam
        $this->db->where('id', $item['id_sarpras']);
        $this->db->update('peralatan');
      }
    }

    return true;
  }


  public function cekPengajuan()
  {
    $user = getProfile('id');
    $this->db->where('id_user', $user);
    $this->db->where('status', 'diajukan');
    $res = $this->db->get('pinjam')->row_array();

    return ($res !== null) ? true : false;
  }

  public function getHistory()
  {
    $this->db->select('id, status, tgl_pinjam, tgl_kembali, catatan',);
    $this->db->from('pinjam');
    $this->db->where('id_user', getProfile('id')); // Filter berdasarkan ID pengguna
    $this->db->where('status !=', 'draft'); // Status tidak sama dengan draft
    $this->db->order_by('id', 'DESC'); // Urutkan berdasarkan tanggal pinjam secara desc
    $query = $this->db->get();

    $result = [];
    foreach ($query->result_array() as $row) {
      // Gunakan fungsi getlist untuk mendapatkan daftar detail_pinjam berdasarkan id_pinjam
      $list = $this->getlist($row['id']);

      // Masukkan ke dalam hasil dengan format yang diminta
      $result[] = [
        'id_pinjam'       => $row['id'],
        'status'          => $row['status'],
        'tgl_pinjam'      => $row['tgl_pinjam'],
        'tgl_kembali' => $row['tgl_kembali'],
        'catatan' => $row['catatan'],
        'list'            => $list,
      ];
    }
    return $result;
  }


  public function getAllPinjam($filter = null)
  {
    $this->db->select('
        pinjam.id AS id_pinjam,
        pinjam.status,
        pinjam.tgl_pinjam,
        pinjam.tgl_kembali,
        pinjam.catatan,
        user.id AS user_id,
        user.fullname AS nama_user,
        user.email AS email_user
    '); // Memilih kolom dari tabel `pinjam` dan `user`
    $this->db->from('pinjam');
    $this->db->join('user', 'user.id = pinjam.id_user', 'left'); // Join ke tabel user
    if ($filter) {
      $this->db->where('pinjam.status', $filter);
    }
    $this->db->order_by('pinjam.id', 'DESC'); // Urutkan berdasarkan ID pinjam secara DESC
    $query = $this->db->get();

    $result = [];
    foreach ($query->result_array() as $row) {
      // Gunakan fungsi getlist untuk mendapatkan daftar detail_pinjam berdasarkan id_pinjam
      $list = $this->getlist($row['id_pinjam']);

      // Masukkan ke dalam hasil dengan format yang diminta
      $result[] = [
        'id_pinjam'       => $row['id_pinjam'],
        'status'          => $row['status'],
        'tgl_pinjam'      => $row['tgl_pinjam'],
        'tgl_kembali'     => $row['tgl_kembali'],
        'catatan'         => $row['catatan'],
        'user' => [
          'id'    => $row['user_id'],
          'nama'  => $row['nama_user'],
          'email' => $row['email_user'],
        ],
        'list'            => $list,
      ];
    }
    return $result;
  }

  public function countPengajuan()
  {
    $this->db->where('status', 'diajukan');
    return $this->db->count_all_results('pinjam');
  }
}
