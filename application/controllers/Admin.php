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
    redirect('admin/dashboard');
  }
  public function dashboard()
  {
    $data['title'] = 'Dashboard';
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/dashboard');
    $this->load->view('templates/admin/footer');
  }

  public function general()
  {
    $data['title'] = 'General';

    $data['general_info'] = $this->ModelUtama->getData();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/general');
    $this->load->view('templates/admin/footer');
  }
  public function add_general()
  {

    $this->form_validation->set_rules('jenis', 'jenis', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('value', 'value', 'required');
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
    $this->form_validation->set_rules('jenis', 'jenis', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('value', 'value', 'required');
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

  public function tahun_ajaran()
  {
    $data['title'] = 'Tahun Ajaran';

    $data['tahun_ajaran'] = $this->ModelUtama->getAllTahunAjaran();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/tahun_ajaran');
    $this->load->view('templates/admin/footer');
  }

  public function add_tahun_ajaran()
  {
    $input = $this->input->post();
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]|is_unique[tahun_ajaran.nama]');
    $this->form_validation->set_rules('started_at', 'Tanggal Mulai', 'required|trim');
    $this->form_validation->set_rules('end_at', 'Tanggal Selesai', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
      $this->session->set_flashdata('message', validation_errors());
      redirect('admin/tahun_ajaran');
    }

    $res = $this->ModelUtama->addTahunAjaran($input);
    $res ?
      $this->session->set_flashdata('message', 'Tahun Ajaran berhasil ditambahkan!') :
      $this->session->set_flashdata('message', 'Tahun Ajaran gagal ditambahkan!');
    redirect('admin/tahun_ajaran');
  }

  public function edit_tahun_ajaran($id)
  {
    $input = $this->input->post();
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('started_at', 'Tanggal Mulai', 'required|trim');
    $this->form_validation->set_rules('end_at', 'Tanggal Selesai', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error  
      $this->session->set_flashdata('message', validation_errors());
      redirect('admin/tahun_ajaran');
    }

    $res = $this->ModelUtama->editTahunAjaran($id, $input);
    $res ?
      $this->session->set_flashdata('message', 'Tahun Ajaran berhasil diupdate!') :
      $this->session->set_flashdata('message', 'Tahun Ajaran gagal diupdate!');
    redirect('admin/tahun_ajaran');
  }

  public function delete_tahun_ajaran($id)
  {
    $res = $this->ModelUtama->deleteTahunAjaran($id);
    $res ?
      $this->session->set_flashdata('message', 'Tahun Ajaran berhasil dihapus!') :
      $this->session->set_flashdata('message', 'Tahun Ajaran gagal dihapus!');
    redirect('admin/tahun_ajaran');
  }
}
