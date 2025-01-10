<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends MY_AdminController
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
  public function logToExcel()
  {
    $data['title'] = 'Log';
    $data['logs'] = $this->ModelTransaksi->getLogs();
    $this->load->view('admin/export/excel/log', $data);
  }
}
