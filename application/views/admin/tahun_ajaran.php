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
                <div class="page-header-icon"><i data-feather="calendar"></i></div>
                Tahun Ajaran
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
              <button id="tambahData" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddGeneral">Tambah Tahun Ajaran</button>
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
                <th>Nama Periode </th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              foreach ($tahun_ajaran as $ta) : ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><?= $ta['nama'] ?>
                    <?php if ($ta['nama'] == getTahunAjaran()) : ?>
                      <div class="badge bg-primary text-white rounded-pill">aktif</div>
                    <?php endif ?>
                  </td>
                  <td><?= dmy($ta['started_at']) ?></td>
                  <td><?= dmy($ta['end_at']) ?></td>
                  <td>
                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $ta['id'] ?>"
                      data-nama="<?= $ta['nama'] ?>"
                      data-started="<?= $ta['started_at'] ?>"
                      data-end="<?= $ta['end_at'] ?>">
                      <i data-feather="edit"></i>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                      data-id="<?= $ta['id'] ?>"
                      data-nama="<?= $ta['nama'] ?>"><i data-feather="trash-2"></i></button>
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
            const nama = $(this).data('nama');
            var u = '<?= base_url('admin/delete_tahun_ajaran/') ?>';

            $('#dihapus').html('Tahun Ajaran ' + nama);
            document.querySelector('#linkHapus').href = u + id;
          });
        });
      </script>


      <!-- Add Modal -->
      <div class="modal fade" id="modalAddGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <form action="<?= base_url('admin/add_tahun_ajaran') ?>" method="post" id="formGeneral">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Tahun Ajaran Baru</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="nama">Nama Periode</label>
                  <input class="form-control" name="nama" id="nama" type="text" placeholder="contoh: <?= date('Y') . '/' . (date('Y') + 1) ?>" required>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="started_at">Tanggal Mulai</label>
                      <input class="form-control" name="started_at" id="started_at" type="date" placeholder="Masukkan Tanggal mulai" required>
                    </div>
                    <div class="col-md-6">
                      <label for="end_at">Tanggal Selesai</label>
                      <input class="form-control" name="end_at" id="end_at" type="date" placeholder="Masukkan Tanggal Selesai" required>
                    </div>
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
            $('#exampleModalCenterTitle').text('Edit Tahun Ajaran');
            console.log($(this).data());
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const started_at = $(this).data('started');
            const end_at = $(this).data('end');

            const formattedStartedAt = started_at.split(' ')[0];
            const formattedEndAt = end_at.split(' ')[0];

            // Isi data ke dalam form modal edit
            $('#nama').val(nama);
            $('#started_at').val(formattedStartedAt);
            $('#end_at').val(formattedEndAt);

            $('#formGeneral').attr('action', '<?= base_url('admin/edit_tahun_ajaran/') ?>' + id);

            // Tampilkan modal edit
            $('#modalEditGeneral').modal('show');
          });

          $('#tambahData').on('click', function() {
            if (inputMode === 'edit') {
              inputMode = 'add';
              $('#exampleModalCenterTitle').text('Tambah Tahun Ajaran');
              $('#nama').val('');
              $('#started_at').val('');
              $('#end_at').val('');

              $('#formGeneral').attr('action', '<?= base_url('admin/add_tahun_ajaran') ?>');
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