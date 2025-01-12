<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="layoutSidenav_content">
  <main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
      <div class="container-xl px-4">
        <div class="page-header-content">
          <div class="row align-items-center justify-content-between pt-3">
            <div class="col-auto mb-3">
              <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="user"></i></div>
                Admin
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
              <button id="tambahData" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddGeneral">Tambah Admin</button>
            </div>
          </div>
        </div>
      </div>
    </header>



    <!-- Main page content-->
    <div class="container-xl px-4">
      <?php if ($this->session->flashdata('message')): ?>
        <div class="floating-alert alert alert-primary alert-icon position-fixed" role="alert">
          <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
          <div class="alert-icon-aside">
            <i class="fas fa-info-circle"></i>
          </div>
          <div class="alert-icon-content">
            <h6 class="alert-heading">Info</h6>
            <?= $this->session->flashdata('message'); ?>
          </div>
          <!-- Loading bar -->
          <div class="loading-bar"></div>
        </div>
        <script>
          $(document).ready(function() {
            // Jalankan loading bar
            $('.loading-bar').animate({
              width: '100%'
            }, 2000);

            // Tutup alert setelah 2 detik
            setTimeout(function() {
              $('.floating-alert').fadeOut('slow', function() {
                $(this).remove();
              });
            }, 4000);
          });
        </script>
        <style>
          /* Styling untuk alert melayang */
          .floating-alert {
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slide-in 0.3s ease-out;
          }

          /* Loading bar */
          .loading-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 0;
            background-color: #007bff;
            /* Warna biru Bootstrap */
            transition: width 2s linear;
          }

          /* Animasi slide-in */
          @keyframes slide-in {
            from {
              transform: translateX(100%);
            }

            to {
              transform: translateX(0);
            }
          }
        </style>
      <?php endif; ?>

      <div class="card mb-4">
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Induk</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Email</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              foreach ($users as $user) : ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><?= $user['nomor_induk'] ?> </td>
                  <td><?= $user['fullname'] ?> </td>
                  <td><?= $user['status'] ?> </td>
                  <td><?= $user['email'] ?> </td>
                  <td>
                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $user['id'] ?>"
                      data-nomor_induk="<?= $user['nomor_induk'] ?>"
                      data-fullname="<?= $user['fullname'] ?>"
                      data-status="<?= $user['status'] ?>"
                      data-email="<?= $user['email'] ?>">
                      <i data-feather="edit"></i>
                    </button>
                    <?php if ($user['id'] != 1 && $user['id'] != getProfile('id')): ?>
                      <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                        data-id="<?= $user['id'] ?>"
                        data-jenis="<?= $user['fullname'] ?>"><i data-feather="trash-2"></i></button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php $index++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>



      <!-- Delete Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Yakin Ingin Menghapus <span id="dihapus" class="text-danger"></span>?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
              <a id="linkHapus" class="btn btn-primary" type="button">Konfirmasi</a>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(function() {
          $('.hapus').on('click', function() {
            const id = $(this).data('id');
            const jenis = $(this).data('jenis');
            var u = '<?= base_url('user/delete_admin/')  ?>';

            $('#dihapus').html(jenis);
            document.querySelector('#linkHapus').href = u + id;
          });
        });
      </script>


      <!-- Add Modal -->
      <div class="modal fade" id="modalAddGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="<?= base_url('user/add_admin') ?>" method="post" id="formGeneral">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Admin</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nomor_induk">Nomor Induk</label>
                  <input class="form-control" name="nomor_induk" id="nomor_induk" type="text" placeholder="Masukkan nomor induk" required>
                </div>
                <div class="mb-3">
                  <label for="fullname">Nama Lengkap</label>
                  <input class="form-control" name="fullname" id="fullname" type="text" placeholder="Masukkan Nama Lengkap" required>
                </div>
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input class="form-control" name="email" id="email" type="email" placeholder="Masukkan email" required>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="password" class="form-label">Password</label>
                      <input class="form-control" name="password" id="password" type="password" placeholder="Masukkan password" required>
                    </div>
                    <div class="col-md-6">
                      <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                      <input class="form-control" name="confirm-password" id="confirm-password" type="password" placeholder="Masukkan konfirmasi password" required>
                    </div>
                  </div>
                </div>
                <!-- <div class="mb-3">
                  <span class="form-label">Status</span>
                  <div class="icon-options">
                    <input type="radio" class="form-check-input" name="ikon" id="guru" value="guru">
                    <label class="icon-label" for="guru">
                      Guru
                      <i data-feather="user"></i>
                    </label><input type="radio" class="form-check-input" name="ikon" id="siswa" value="siswa">
                    <label class="icon-label" for="siswa">
                      Siswa
                      <i data-feather="users"></i>
                    </label>
                  </div>
                </div> -->

                <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary" type="submit">Simpan</button></div>
            </form>
          </div>
        </div>
      </div>


      <script>
        $(function() {
          let inputMode = 'unset';
          // Ketika tombol edit diklik
          $('.edit').on('click', function() {
            inputMode = 'edit';
            $('#exampleModalCenterTitle').text('Edit Admin');
            const id = $(this).data('id');
            const fullname = $(this).data('fullname');
            const nomor_induk = $(this).data('nomor_induk');
            const email = $(this).data('email');
            const status = $(this).data('status');

            // Isi data ke dalam form modal edit
            $('#fullname').val(fullname);
            $('#nomor_induk').val(nomor_induk);
            $('#email').val(email);
            $('#status').val(status);

            $('#password').prop('required', false);
            $('#confirm-password').prop('required', false);
            $('#formGeneral').attr('action', '<?= base_url('user/edit_admin/') ?>' + id);


            // Tampilkan modal edit
            $('#modalEditGeneral').modal('show');
          });

          $('#tambahData').on('click', function() {
            if (inputMode === 'edit') {
              $('#exampleModalCenterTitle').text('Tambah Admin');
              inputMode = 'add';
              $('#password').prop('required', true);
              $('#confirm-password').prop('required', true);
              $('#fullname').val('');
              $('#nomor_induk').val('');
              $('#email').val('');
              $('#status').val('');
              $('#formGeneral').attr('action', '<?= base_url('user/add_admin') ?>');
            }

            if (inputMode === 'unset') {
              inputMode = 'add';

            }
          });

        });
      </script>




      <!-- <tr>
        <td>Tiger Nixon</td>
        <td>System Architect</td>
        <td>Edinburgh</td>
        <td>61</td>
        <td>2011/04/25</td>
        <td>$320,800</td>
        <td>
          <div class="badge bg-primary text-white rounded-pill">Full-time</div>
        </td>
        <td>
          <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="more-vertical"></i></button>
          <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
        </td>
      </tr> -->