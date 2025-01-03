<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sarpras extends MY_AdminController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelSarpras');
  }

  public function index()
  {
    // $this->dashboard();
  }
  public function kategori()
  {
    $data['ruang'] = $this->ModelSarpras->getCategories("Ruang");
    $data['peralatan'] = $this->ModelSarpras->getCategories("Peralatan");
    $data['subPeralatan'] = $this->ModelSarpras->getCategories("subPeralatan");
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/sarpras/kategori');
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
