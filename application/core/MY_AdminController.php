<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_AdminController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->authenticate();
    $this->tahun_ajaran();
  }

  protected function authenticate()
  {
    if ($this->session->userdata('role') !== 'admin') {
      redirect('auth/login');
    }
  }

  protected function tahun_ajaran()
  {
    $tahun_ajaran = $this->ModelUtama->getTahunAjaran();
    if (!$tahun_ajaran) {
      redirect('admin/general');
    }
  }
};
