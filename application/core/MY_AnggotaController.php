<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_AnggotaController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->authenticate();
  }

  protected function authenticate()
  {
    if ($this->session->userdata('nomor_induk') === null) {
      redirect('auth/login');
    }
    if ($this->session->userdata('role') !== 'anggota') {
      redirect('home');
    }
  }
};
