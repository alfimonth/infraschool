<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_AdminController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelUser');
  }

  public function index()
  {
    $this->admin();
  }

  public function admin()
  {
    $data['title'] = 'User';
    $data['filter'] = 'admin';

    $data['users'] = $this->ModelUser->getAllAdminUser();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/user/index');
    $this->load->view('templates/admin/footer');
  }

  public function anggota($filter = null)
  {
    $data['title'] = 'Anggota';
    $data['filter'] = $filter;

    $data['users'] = $this->ModelUser->getAllAnggotaUser($filter);
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/user/index');
    $this->load->view('templates/admin/footer');
  }

  public function add_kategori()
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('tipe', 'Tipe', 'required');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
      $this->session->set_flashdata('message', validation_errors());
      redirect('sarpras/kategori');
    } else {
      // Jika validasi berhasil, simpan data ke database
      $input = $this->input->post();
      $res = $this->ModelSarpras->add($input);
      $res ?
        $this->session->set_flashdata('message', 'Ketegori ' . $input['tipe'] . ' berhasil ditambahkan!') :
        $this->session->set_flashdata('message', 'Ketegori ' . $input['tipe'] . ' gagal ditambahkan!');

      redirect('sarpras/kategori');
    }
  }

  function edit_kategori($id)
  {
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[100]');
    $this->form_validation->set_rules('tipe', 'Tipe', 'required');

    if ($this->form_validation->run() == FALSE) {
      // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
      $this->session->set_flashdata('message', validation_errors());
      redirect('sarpras/kategori');
    } else {
      // Jika validasi berhasil, simpan data ke database
      $input = $this->input->post();
      $res = $this->ModelSarpras->edit($input, $id);
      $res ?
        $this->session->set_flashdata('message', 'Ketegori ' . $input['tipe'] . ' berhasil diubah!') :
        $this->session->set_flashdata('message', 'Ketegori ' . $input['tipe'] . ' gagal diubah!');

      redirect('sarpras/kategori');
    }
  }

  public function delete_kategori($id)
  {
    $res = $this->ModelSarpras->delete($id);
    $res ?
      $this->session->set_flashdata('message', 'Ketegori berhasil dihapus!') :
      $this->session->set_flashdata('message', 'Ketegori gagal dihapus!');

    redirect('sarpras/kategori');
  }
}
