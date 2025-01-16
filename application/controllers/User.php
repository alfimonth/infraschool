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
    $data['tipe'] = 'admin';
    $data['title'] = 'User';
    $data['filter'] = '';

    $data['users'] = $this->ModelUser->getAllAdminUser();
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/user/index');
    $this->load->view('templates/admin/footer');
  }

  public function add_admin()
  {

    $input = $this->input->post();
    // var_dump($input);
    // die;

    $this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'required|numeric|is_unique[user.nomor_induk]');
    $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');


    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      backPage();
    } else {
      unset($input['confirm_password']);
      $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
      $res = $this->ModelUser->add($input);
      $res ?
        $this->session->set_flashdata('message', 'Data admin berhasil ditambahkan') :
        $this->session->set_flashdata('message', 'Data admin gagal ditambahkan');
      backPage();
    }
  }

  public function edit_admin($id)
  {
    $input = $this->input->post();
    // Validasi data umum
    $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


    // Jalankan validasi
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      backPage();
      return; // Pastikan fungsi berhenti jika validasi gagal
    }

    // Jika password diisi, hash password dan masukkan ke array data
    if (!empty($input['password'])) {
      $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
    } else {
      // Jika password tidak diisi, hapus dari array input
      unset($input['password']);
    }

    // Hapus confirm_password dari input
    unset($input['confirm_password']);

    // Update data di database
    $res = $this->ModelUser->edit($id, $input);

    // Flash message berdasarkan hasil update
    if ($res) {
      $this->session->set_flashdata('message', 'Data admin berhasil diubah');
    } else {
      $this->session->set_flashdata('message', 'Data admin gagal diubah');
    }

    backPage();
  }


  public function delete_admin($id)
  {
    $res = $this->ModelUser->delete($id);
    $res ?
      $this->session->set_flashdata('message', 'Data admin berhasil dihapus') :
      $this->session->set_flashdata('message', 'Data admin gagal dihapus');
    backPage();
  }

  public function anggota($filter = null)
  {
    $data['tipe'] = 'anggota';
    $data['title'] = 'Anggota';
    $data['filter'] = $filter;

    $data['users'] = $this->ModelUser->getAllAnggotaUser($filter);
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/user/index');
    $this->load->view('templates/admin/footer');
  }

  public function add_bulk()
  {
    $this->load->library('upload');

    // Konfigurasi upload file
    $config['upload_path'] = './public/uploads/user/';
    $config['allowed_types'] = 'xls|xlsx';
    $config['max_size'] = 2048;
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('file_excel')) {
      $this->session->set_flashdata('message', $this->upload->display_errors());
      backPage();
    } else {
      $file = $this->upload->data('full_path');

      // Load PhpSpreadsheet
      try {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $insertData = [];
        foreach ($sheetData as $key => $row) {
          if ($key === 1) continue; // Skip header row

          // Sesuaikan dengan struktur kolom template
          $insertData[] = [
            'nomor_induk' => $row['B'],
            'fullname' => $row['C'],
            'email' => $row['D'],
            'password' => password_hash($row['E'], PASSWORD_DEFAULT),
            'role' => $row['F'],
            'status' => $row['G'],
          ];
        }

        // Masukkan ke database
        if (!empty($insertData)) {
          $res = $this->ModelUser->add_batch($insertData);
          $res ?
            $this->session->set_flashdata('message', $res['inserted'] . ' user ditambahkan, ' . $res['skipped'] . ' data diskip') : $this->session->set_flashdata('message', 'Data anggota gagal ditambahkan');
        } else {
          $this->session->set_flashdata('message', 'Data kosong atau tidak valid.');
        }
      } catch (Exception $e) {
        $this->session->set_flashdata('message', 'Error: ' . $e->getMessage());
      }

      // Hapus file setelah diproses
      var_dump($file);
      $handle = fopen($file, 'r');
      fclose($handle);
      unlink($file);

      backPage();
    }
  }
}
