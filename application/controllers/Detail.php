<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelSarpras');
  }

  public function room($id)
  {
    $data['title'] = 'Detail Room';
    $data['room'] = $this->ModelSarpras->getRoom($id);

    $this->load->view('templates/main_header', $data);
    $this->load->view('anggota/detail/room');
    $this->load->view('templates/main_footer');
  }

  public function peralatan($id)
  {
    $data['title'] = 'Detail Tool';
    $data['tool'] = $this->ModelSarpras->getTool($id);
    $this->load->view('templates/main_header', $data);
    $this->load->view('anggota/detail/peralatan');
    $this->load->view('templates/main_footer');
  }
}
