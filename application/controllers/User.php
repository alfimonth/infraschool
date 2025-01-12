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

  public function add_admin()
  {
    $data['title'] = 'Tambah Admin';
    $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required|numeric|is_unique[user.nomor_induk]');
    $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm-password', 'Konfirmasi Password', 'required|matches[password]');


    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      redirect('user/admin');
    } else {
      $input = $this->input->post();
      unset($input['confirm-password']);

      $input['role'] = 'admin';
      $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
      $res = $this->ModelUser->add($input);
      $res ?
        $this->session->set_flashdata('message', 'Data admin berhasil ditambahkan') :
        $this->session->set_flashdata('message', 'Data admin gagal ditambahkan');
      redirect('user/admin');
    }
  }

  public function edit_admin($id)
  {
    $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');;



    $input = $this->input->post();
    if (isset($input['password']) && $input['password'] != '') {
      $this->form_validation->set_rules('password', 'Password', 'matches[confirm-password]');
      $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
    } else {
      unset($input['password']);
      unset($input['confirm-password']);
    }

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      redirect('user/admin');
    }

    $res = $this->ModelUser->edit($id, $input);
    $res ?
      $this->session->set_flashdata('message', 'Data admin berhasil diubah') :
      $this->session->set_flashdata('message', 'Data admin gagal diubah');
    redirect('user/admin');
  }

  public function delete_admin($id)
  {
    $res = $this->ModelUser->delete($id);
    $res ?
      $this->session->set_flashdata('message', 'Data admin berhasil dihapus') :
      $this->session->set_flashdata('message', 'Data admin gagal dihapus');
    redirect('user/admin');
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
}
