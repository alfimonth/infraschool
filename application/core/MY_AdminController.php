<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_AdminController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->authenticate();
    $this->check_tahun_ajaran();
  }

  protected function authenticate()
  {
    if ($this->session->userdata('role') !== 'admin') {
      redirect('home');
    }
  }

  protected function check_tahun_ajaran()
  {

    $tahun_ajaran = $this->ModelUtama->getTahunAjaran();
    if (
      !$tahun_ajaran
      && uri_string() !== 'admin/tahun_ajaran'
      && uri_string() !== 'admin/add_tahun_ajaran'
      && strpos(uri_string(), 'admin/edit_tahun_ajaran') === false
    ) {
      $this->session->set_flashdata('message', 'Harus ada tahun ajaran aktif untuk mengakses fungsi admin');
      redirect('admin/tahun_ajaran');
    }
  }
};
