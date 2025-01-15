<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends MY_AnggotaController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    var_dump($this->session->userdata());
  }
  
}
