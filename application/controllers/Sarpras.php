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
  public function ruang()
  {
    $data['title'] = 'Ruang';

    $data['rooms'] = $this->ModelSarpras->getRooms();
    $data['categories'] = $this->ModelSarpras->getCategories("Ruang");
    $this->load->view('templates/admin/header', $data);
    $this->load->view('admin/sarpras/ruang');
    $this->load->view('templates/admin/footer');
  }

  public function add_ruang()
  {
    $this->form_validation->set_rules('jenis', 'Jenis Ruangan', 'required');
    $this->form_validation->set_rules('panjang', 'Panjang', 'required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'required|numeric');
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
    if ($this->input->post('id_kategori') === 'new') {
      $this->form_validation->set_rules('new_kategori', 'Kategori Baru', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      redirect('sarpras/ruang');
    } else {
      $config['upload_path'] = './public/uploads/sarpras/ruang/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = 1024; // 1MB
      $config['file_name'] = time() . '-' . $_FILES['image']['name'];

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('image')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('sarpras/ruang');
      } else {
        $upload_data = $this->upload->data();
        $image_path = $upload_data['file_name'];

        // Data untuk disimpan ke database
        $data = [
          'jenis' => $this->input->post('jenis'),
          'panjang' => $this->input->post('panjang'),
          'lebar' => $this->input->post('lebar'),
          'id_kategori' => $this->input->post('id_kategori') === 'new' ?
            $this->ModelSarpras->add([
              'tipe' => "Ruang",
              'nama' => $this->input->post('new_kategori')
            ]) :
            $this->input->post('id_kategori'),
          'image' => $image_path,
        ];

        // Simpan ke database
        $this->ModelSarpras->addRoom($data);

        $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
        redirect('sarpras/ruang');
      }
    }
  }

  public function edit_ruang($id)
  {
    $data['title'] = 'Edit Ruangan';
    $this->form_validation->set_rules('jenis', 'Jenis Ruangan', 'required');
    $this->form_validation->set_rules('panjang', 'Panjang', 'required|numeric');
    $this->form_validation->set_rules('lebar', 'Lebar', 'required|numeric');
    $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
    if ($this->input->post('id_kategori') === 'new') {
      $this->form_validation->set_rules('new_kategori', 'Kategori Baru', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', validation_errors());
      redirect('sarpras/ruang');
    } else {
      if (!empty($_FILES['image']['name'])) {

        $config['upload_path'] = './public/uploads/sarpras/ruang/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 1024; // 1MB
        $config['file_name'] = time() . '-' . $_FILES['image']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
          $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('sarpras/ruang');
        } else {
          $upload_data = $this->upload->data();
          $image_path = $upload_data['file_name'];
        }
      }

      $data = [
        'jenis' => $this->input->post('jenis'),
        'panjang' => $this->input->post('panjang'),
        'lebar' => $this->input->post('lebar'),
        'id_kategori' => $this->input->post('id_kategori') === 'new' ?
          $this->ModelSarpras->add([
            'tipe' => "Ruang",
            'nama' => $this->input->post('new_kategori')
          ]) :
          $this->input->post('id_kategori'),
      ];

      if (!empty($_FILES['image']['name'])) {
        $data['image'] = $image_path;
        $res = $this->db->select('image')->where('id', $id)->get('ruang')->row_array();
        $image_path = './public/uploads/sarpras/ruang/' . $res['image'];
        if (file_exists($image_path)) {
          unlink($image_path);
        }
      }

      $res = $this->ModelSarpras->editRoom($data, $id);

      $res ?
        $this->session->set_flashdata('message', 'Ruang berhasil diubah!') :
        $this->session->set_flashdata('message', 'Ruang gagal diubah!');

      redirect('sarpras/ruang');
    }
  }

  public function delete_ruang($id)
  {

    $res = $this->ModelSarpras->deleteRoom($id);
    $res ?
      $this->session->set_flashdata('message', 'Ruang berhasil dihapus!') :
      $this->session->set_flashdata('message', 'Ruang gagal dihapus!');

    redirect('sarpras/ruang');
  }

  public function kategori()
  {
    $data['title'] = 'Kategori';

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
