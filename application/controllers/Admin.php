<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_AdminController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->dashboard();
  }
  public function dashboard()
  {
    $this->load->view('templates/admin/header');
    $this->load->view('admin/dashboard');
    $this->load->view('templates/admin/footer');
  }

  public function general()
  {
    $data['general_info'] = $this->ModelUtama->getData();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/general');
    $this->load->view('templates/admin/footer');
  }
  public function add_general()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('nilai', 'Nilai', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim|max_length[50]');
    $this->form_validation->set_rules('ikon', 'Ikon', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
      $this->session->set_flashdata('message', validation_errors());
      redirect('admin/general');
    } else {
      // Jika validasi berhasil, simpan data ke database
      $input = $this->input->post();
      $this->ModelUtama->add($input);
      $this->session->set_flashdata('message', 'Data berhasil ditambahkan!');
      redirect('admin/general');
    }
  }


  public function edit_general($id)
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('nilai', 'Nilai', 'required');
    $this->form_validation->set_rules('satuan', 'Satuan', 'required|trim|max_length[50]');
    $this->form_validation->set_rules('ikon', 'Ikon', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
      $this->session->set_flashdata('message', validation_errors());
      redirect('admin/general');
    } else {
      // Jika validasi berhasil, update data di database
      $data = $this->input->post();
      $this->ModelUtama->edit($data, $id);
      $this->session->set_flashdata('message', 'Data berhasil diupdate!');
      redirect('admin/general');
    }
  }


  public function delete_general($id)
  {
    $this->ModelUtama->delete($id);
    $this->session->set_flashdata('message', 'Data berhasil dihapus!');
    redirect('admin/general');
  }
}
