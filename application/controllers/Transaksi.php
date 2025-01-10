<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MY_AdminController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelTransaksi');
    $this->load->model('ModelSarpras');
  }

  public function index()
  {
    redirect('transaksi/log');
  }

  // Ruangan
  public function log()
  {
    $data['title'] = 'Log';
    $data['logs'] = $this->ModelTransaksi->getLogs();
    $data['rooms'] = $this->ModelSarpras->getRooms();
    $data['tools'] = $this->ModelSarpras->getTools();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/transaksi/log');
    $this->load->view('templates/admin/footer');
  }

  public function add_log()
  {
    $updateStok = [];
    $data = $this->input->post(null, true);

    if ($data['tipe'] == "masuk") {
      $updateStok['baik'] = intval($data['jumlah']);
      $updateStok['rusak'] = 0;
    };

    if ($data['tipe'] == 'keluar') {
      $updateStok['baik'] = intval($data['jumlah']) * -1;
      $updateStok['rusak'] = 0;
    }

    if ($data['tipe'] == 'rusak') {
      $updateStok['baik'] = intval($data['jumlah']) * -1;
      $updateStok['rusak'] = intval($data['jumlah']);
    }

    if ($data['tipe'] == 'perbaikan') {
      $updateStok['baik'] = intval($data['jumlah']);
      $updateStok['rusak'] = intval($data['jumlah']) * -1;
    }

    $this->ModelSarpras->updateStok(
      $data['id_sarpras'],
      $data['kategori_sarpras'],
      $updateStok
    );

    $data['id_user'] = $this->session->userdata('id');
    $res = $this->ModelTransaksi->addLog($data);
    $res ?
      $this->session->set_flashdata('message', 'Log berhasil ditambahkan!') :
      $this->session->set_flashdata('message', 'Log gagal ditambahkan!');

    redirect('transaksi/log');
  }
}