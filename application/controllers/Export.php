<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Export extends MY_AdminController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelTransaksi');
    $this->load->model('ModelSarpras');
    $this->load->model('ModelPinjam');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {
    // Data untuk ditampilkan
    $data['general_info'] = $this->ModelUtama->getData();
    $data['ruang'] = $this->ModelSarpras->getDetailedCategories('Ruang');
    $data['peralatan'] = $this->ModelSarpras->getDetailedCategories('Peralatan');
    $data['admin'] = $this->session->userdata('fullname');

    // dd($data);
    $this->load->view('admin/export/print/sarpras', $data);
  }

  // Ruangan
  public function logToExcel()
  {
    $data['title'] = 'Log';
    $data['logs'] = $this->ModelTransaksi->getLogs();
    $this->load->view('admin/export/excel/log', $data);
  }

  public function logToPdf()
  {
    $data['title'] = 'Log';
    $data['logs'] = $this->ModelTransaksi->getLogs();
    $this->load->view('admin/export/pdf/log', $data);
  }

  public function logPrint()
  {
    $data['logs'] = $this->ModelTransaksi->getLogs();

    $this->load->view('admin/export/print/log', $data);
  }

  public function sarprasToExcel()
  {
    $data['title'] = 'Sarpras';
    $data['sarpras'] = $this->ModelSarpras->getSarpras();
    $this->load->view('admin/export/excel/sarpras', $data);
  }

  public function sarprasToPdf()
  {
    $data['title'] = 'Sarpras';
    $data['sarpras'] = $this->ModelSarpras->getSarpras();
    $this->load->view('admin/export/pdf/sarpras', $data);
  }

  public function sarprasPrint()
  {
    $data['sarpras'] = $this->ModelSarpras->getSarpras();

    $this->load->view('admin/export/print/sarpras', $data);
  }

  public function pinjamToExcel()
  {
    $data['title'] = 'Pinjam';
    $data['pinjam'] = $this->ModelPinjam->getAllPinjam();
    $this->load->view('admin/export/excel/pinjam', $data);
  }

  public function pinjamToPdf()
  {
    $data['title'] = 'Pinjam';
    $data['pinjam'] = $this->ModelPinjam->getAllPinjam();
    $this->load->view('admin/export/pdf/pinjam', $data);
  }

  public function pinjamPrint()
  {
    $data['pinjam'] = $this->ModelPinjam->getAllPinjam();
    $this->load->view('admin/export/print/pinjam', $data);
  }
}
