<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends MY_AnggotaController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelSarpras');
    $this->load->model('ModelPinjam');
  }

  public function index()
  {
    $data['title'] = 'Daftar pinjam';
    $draft = $this->ModelPinjam->getDraft();
    $data['list'] = $this->ModelPinjam->getList($draft['id']);
    $data['draft'] = $draft;

    $this->load->view('templates/main_header', $data);
    $this->load->view('anggota/pinjam/list');
    $this->load->view('templates/main_footer');
  }

  public function add_list($id)
  {
    $input = $this->input->post(null, true);
    $draft = $this->ModelPinjam->getDraft();

    //cek dulu apakah id_sarpras dengan tipe tsb sudah ada di draft jika sudah ada set session dan redirect ke pinjam
    // Periksa apakah item sudah ada di draft
    $existingItem = $this->db->get_where('detail_pinjam', [
      'id_pinjam' => $draft['id'],
      'id_sarpras' => $id,
      'tipe' => $input['tipe']
    ])->row_array();

    if ($existingItem) {
      $this->session->set_flashdata('error', 'Sarpras sudah ada di daftar pinjam!');
      redirect('pinjam');
    }

    $data = [
      'id_pinjam' => $draft['id'],
      'id_sarpras' => $id,
      'tipe' => $input['tipe'],
      'jumlah' => $input['jumlah']
    ];
    $res = $this->ModelPinjam->addToList($data);
    $res ?
      $this->session->set_flashdata('success', 'Sarpras ditambahkan') :
      $this->session->set_flashdata('error', 'Sarpras gagal ditambahkan');
    redirect('pinjam');
  }

  public function edit_list($id)
  {
    $input = $this->input->get('jumlah');

    $data = [
      'id' => $id,
      'jumlah' => $input
    ];

    $res = $this->ModelPinjam->updateList($data);
    $res ?
      $this->session->set_flashdata('success', 'Jumlah sarpras diubah') :
      $this->session->set_flashdata('error', 'Jumlah sarpras gagal diubah');

    backPage();
  }

  public function delete_list($id)
  {
    $res = $this->ModelPinjam->deleteList($id);
    $res ?
      $this->session->set_flashdata('success', 'Sarpras dihapus dari daftar') :
      $this->session->set_flashdata('error', 'Sarpras gagal dihapus dari daftar');

    backPage();
  }

  public function pengajuan($id)
  {
    if ($this->ModelPinjam->cekPengajuan()) {
      $this->session->set_flashdata('error', 'Pengajuan sebelumnya belum selesai!');
      redirect('pinjam/riwayat');
    }
    $res = $this->ModelPinjam->ajukan($id);
    $res ?
      $this->session->set_flashdata('success', 'Pengajuan berhasil dikirim') :
      $this->session->set_flashdata('error', 'Pengajuan gagal dikirim');

    redirect('pinjam/riwayat');
  }

  public function riwayat()
  {
    $data['title'] = 'Riwayat pinjam';
    $data['list'] = $this->ModelPinjam->getHistory();

    $this->load->view('templates/main_header', $data);
    $this->load->view('anggota/pinjam/riwayat');
    $this->load->view('templates/main_footer');
  }
}
