<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ModelUser');
  }
  public function login()
  {
    $data['title'] = 'Login';

    if ($this->session->userdata('role') == 'admin') {
      redirect('admin');
    }

    $this->form_validation->set_rules(
      'nomor_induk',
      'Nomor Induk',
      'required|trim|numeric',
      ['required' => 'Nomor Induk Harus diisi', 'numeric' => 'Nomor Induk harus berupa angka']
    );
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required|trim',
      ['required' => 'Password Harus diisi']
    );

    if ($this->form_validation->run() == false) {
      $data['user'] = '';
      //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header

      $this->load->view('login', $data);
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $nomor_induk = htmlspecialchars($this->input->post('nomor_induk', true));
    $password = $this->input->post('password', true);
    $user = $this->ModelUser->cekUser($nomor_induk);

    if ($user) { //jika user sudah ada //cek password 
      if (password_verify($password, $user['password'])) {
        $this->session->set_userdata($user);
        if ($user['role'] == 'admin') {
          redirect('admin');
        } else {
          redirect('home');
        }
      } else {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>');
        redirect('auth/login');
      }
    } else {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Nomor induk terdaftar!!</div>');
      redirect('auth/login');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah logout!!</div>');
    redirect('auth/login');
  }
}
