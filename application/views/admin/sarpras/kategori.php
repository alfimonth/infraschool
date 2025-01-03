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
                <div class="page-header-icon"><i data-feather="globe"></i></div>
                Kategori Sarana Prasarana
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
              <button id="tambahData" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddGeneral">Tambah Kategori</button>
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

      <div class="card card-collapsable mb-4">
        <a class="card-header" href="#kategori1" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="kategori1">Kategori Ruangan
          <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
          </div>
        </a>
        <div class="collapse show" id="kategori1">
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 1;
                foreach ($ruang as $category) : ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $category['nama'] ?> </td>
                    <td>0</td>
                    <td>
                      <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"
                        data-tipe="<?= $category['tipe'] ?>">
                        <i data-feather="edit"></i>
                      </button>
                      <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"><i data-feather="trash-2"></i></button>
                    </td>
                  </tr>
                <?php $index++;
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card card-collapsable mb-4">
        <a class="card-header" href="#kategori2" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="kategoriPeralatan">Kategori Peralatan
          <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
          </div>
        </a>
        <div class="collapse show" id="kategori2">
          <div class="card-body">
            <table id="kategoriPeralatan">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 1;
                foreach ($peralatan as $category) : ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $category['nama'] ?> </td>
                    <td>0</td>
                    <td>
                      <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"
                        data-tipe="<?= $category['tipe'] ?>">
                        <i data-feather="edit"></i>
                      </button>
                      <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"><i data-feather="trash-2"></i></button>
                    </td>
                  </tr>
                <?php $index++;
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card card-collapsable mb-4">
        <a class="card-header" href="#kategori3" data-bs-toggle="collapse" role="button" aria-expanded="true" aria-controls="kategoriPeralatan">Sub Kategori Peralatan
          <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
          </div>
        </a>
        <div class="collapse show" id="kategori3">
          <div class="card-body">
            <table id="subKategoriPeralatan">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 1;
                foreach ($subPeralatan as $category) : ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $category['nama'] ?> </td>
                    <td>0</td>
                    <td>
                      <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"
                        data-tipe="<?= $category['tipe'] ?>">
                        <i data-feather="edit"></i>
                      </button>
                      <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                        data-id="<?= $category['id'] ?>"
                        data-nama="<?= $category['nama'] ?>"><i data-feather="trash-2"></i></button>
                    </td>
                  </tr>
                <?php $index++;
                endforeach; ?>
              </tbody>
            </table>
          </div>
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
            const nama = $(this).data('nama');
            var u = '<?= base_url('sarpras/delete_kategori/') ?>';

            $('#dihapus').html(nama);
            document.querySelector('#linkHapus').href = u + id;
          });
        });
      </script>


      <!-- Add Modal -->
      <div class="modal fade" id="modalAddGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="<?= base_url('sarpras/add_kategori') ?>" method="post" id="formGeneral">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kategori</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nama">Nama Kategori</label>
                  <input class="form-control" name="nama" id="nama" type="text" placeholder="Masukkan nama kategori" required>
                </div>

                <div class="mb-3">
                  <span class="form-label">Tipe</span>
                  <div class="icon-options">
                    <input type="radio" class="form-check-input" name="tipe" id="Ruang" value="Ruang">
                    <label class="icon-label" for="Ruang">
                      Ruang <i data-feather="home"></i>
                    </label>
                    <input type="radio" class="form-check-input" name="tipe" id="Peralatan" value="Peralatan">
                    <label class="icon-label" for="Peralatan">
                      Peralatan <i data-feather="tool"></i>
                    </label>
                    <input type="radio" class="form-check-input" name="tipe" id="SubPeralatan" value="SubPeralatan">
                    <label class="icon-label" for="SubPeralatan">
                      Sub Peralatan <i data-feather="tool"></i>
                    </label>
                  </div>
                </div>

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
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const tipe = $(this).data('tipe');

            // Isi data ke dalam form modal edit
            $('#nama').val(nama);
            $(`#${tipe}`).prop('checked', true);

            $('#formGeneral').attr('action', '<?= base_url('sarpras/edit_kategori/') ?>' + id);

            // Tampilkan modal edit
            $('#modalEditGeneral').modal('show');
          });

          $('#tambahData').on('click', function() {
            if (inputMode === 'edit') {
              inputMode = 'add';
              $('#nama').val('');
              $(`#Ruang`).prop('checked', true);
              $('#formGeneral').attr('action', '<?= base_url('sarpras/add_kategori') ?>');
            }

            if (inputMode === 'unset') {
              inputMode = 'add';
              $(`#ikon_activity`).prop('checked', true);
            }
          });

        });
      </script>