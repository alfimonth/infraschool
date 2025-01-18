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
                <div class="page-header-icon"><i data-feather="repeat"></i></div>
                Peminjaman <?= $title ?>
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
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
          <a href="<?= base_url('export/pinjamToExcel') ?>" class="btn btn-success mb-3"><i class="fas fa-file-excel me-2"></i>Excel </a>
          <a href="<?= base_url('export/pinjamToPdf') ?>" class="btn btn-danger mb-3"><i class="fas fa-file-pdf me-2"></i>Pdf </a>
          <a href="<?= base_url('export/pinjamPrint') ?>" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print me-2"></i>Print </a>
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Catatan</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Aksi</th>
                <!-- <th>Aksi</th> -->
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              foreach ($pinjam as $pinjam) : ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><?= $pinjam['user']['nama'] ?> </td>
                  <td><?= $pinjam['catatan'] ?> </td>
                  <td><?= dmy($pinjam['tgl_pinjam']) ?> </td>
                  <td><?= dmy($pinjam['tgl_kembali']) ?> </td>
                  <td>
                    <button
                      class="btn btn-datatable btn-icon btn-info btn-view-detail"
                      data-nama="<?= $pinjam['user']['nama'] ?>"
                      data-catatan="<?= $pinjam['catatan'] ?>"
                      data-tgl-pinjam="<?= dmy($pinjam['tgl_pinjam']) ?>"
                      data-tgl-kembali="<?= dmy($pinjam['tgl_kembali']) ?>"
                      data-sarpras='<?= json_encode($pinjam['list']) ?>'
                      title="Lihat Detail">
                      <i data-feather="eye"></i>
                    </button>

                    <?php if ($title === 'diajukan'): ?>
                      <button
                        class="btn btn-datatable btn-icon btn-success btn-approve"
                        data-id="<?= $pinjam['id_pinjam'] ?>"
                        title="Setujui">
                        <i data-feather="check"></i>
                      </button>
                      <button
                        class="btn btn-datatable btn-icon btn-danger btn-reject"
                        data-id="<?= $pinjam['id_pinjam'] ?>"
                        title="Tolak">
                        <i data-feather="x"></i>
                      </button>
                    <?php endif; ?>
                    <?php if ($title === 'dipinjam') : ?>
                      <button
                        class="btn btn-datatable btn-icon btn-success btn-kembali"
                        data-id="<?= $pinjam['id_pinjam'] ?>"
                        title="Dikembalikan">
                        <i data-feather="arrow-left"></i>
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php $index++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>


      <!-- View Modal -->
      <div class="modal fade" id="modalViewDetail" tabindex="-1" role="dialog" aria-labelledby="viewDetailTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewDetailTitle">Detail Peminjaman</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <h6>Informasi Peminjaman</h6>
                <ul class="list-unstyled">
                  <li><strong>Nama Peminjam:</strong> <span id="detailNama"></span></li>
                  <li><strong>Catatan:</strong> <span id="detailCatatan"></span></li>
                  <li><strong>Tanggal Pinjam:</strong> <span id="detailTanggalPinjam"></span></li>
                  <li><strong>Tanggal Kembali:</strong> <span id="detailTanggalKembali"></span></li>
                </ul>
              </div>
              <div class="mb-3">
                <h6>Daftar Sarpras</h6>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Sarpras</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody id="detailSarprasList">
                    <!-- List data akan dimasukkan melalui JavaScript -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          // Event listener untuk tombol "View"
          $('.btn-view-detail').on('click', function() {
            // Ambil data dari atribut tombol
            const nama = $(this).data('nama');
            const catatan = $(this).data('catatan');
            const tanggalPinjam = $(this).data('tgl-pinjam');
            const tanggalKembali = $(this).data('tgl-kembali');
            const sarprasList = $(this).data('sarpras'); // Data list sarpras dalam bentuk array JSON

            // Set data ke dalam modal
            $('#detailNama').text(nama);
            $('#detailCatatan').text(catatan);
            $('#detailTanggalPinjam').text(tanggalPinjam);
            $('#detailTanggalKembali').text(tanggalKembali);

            // Bersihkan tabel sebelum diisi
            $('#detailSarprasList').empty();

            // Loop untuk mengisi data list sarpras ke dalam tabel
            sarprasList.forEach((item, index) => {
              $('#detailSarprasList').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_sarpras}</td>
                        <td>${item.jumlah}</td>
                    </tr>
                `);
            });

            // Tampilkan modal
            $('#modalViewDetail').modal('show');
          });
        });
      </script>

      <!-- Modal Konfirmasi -->
      <div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Aksi</h5>
              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="modalKonfirmasiMessage"></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
              <form id="formKonfirmasi" method="POST" action="">
                <button type="submit" class="btn btn-primary" id="modalKonfirmasiButton"></button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          // Event listener untuk tombol "Setujui"
          $('.btn-approve').on('click', function() {
            const id = $(this).data('id');
            const url = `<?= base_url('transaksi/approve/') ?>${id}`;

            $('#modalKonfirmasiLabel').text('Konfirmasi Persetujuan');
            $('#modalKonfirmasiMessage').text('Apakah Anda yakin ingin menyetujui peminjaman ini?');
            $('#formKonfirmasi').attr('action', url);
            $('#modalKonfirmasiButton').text('Setujui');
            $('#modalKonfirmasiButton').addClass('btn-success').removeClass('btn-danger');

            $('#modalKonfirmasi').modal('show');
          });

          // Event listener untuk tombol "Tolak"
          $('.btn-reject').on('click', function() {
            const id = $(this).data('id');
            const url = `<?= base_url('transaksi/reject/') ?>${id}`;

            $('#modalKonfirmasiLabel').text('Konfirmasi Penolakan');
            $('#modalKonfirmasiMessage').text('Apakah Anda yakin ingin menolak peminjaman ini?');
            $('#formKonfirmasi').attr('action', url);
            $('#modalKonfirmasiButton').text('Tolak');
            $('#modalKonfirmasiButton').addClass('btn-danger').removeClass('btn-success');

            $('#modalKonfirmasi').modal('show');
          });

          $('.btn-kembali').on('click', function() {
            const id = $(this).data('id');
            const url = `<?= base_url('transaksi/kembali/') ?>${id}`;

            $('#modalKonfirmasiLabel').text('Konfirmasi Pengembalian');
            $('#modalKonfirmasiMessage').text('Apakah Anda yakin sarpras telah dikembalikan?');
            $('#formKonfirmasi').attr('action', url);
            $('#modalKonfirmasiButton').text('Konfirmasi');
            $('#modalKonfirmasiButton').addClass('btn-success').removeClass('btn-danger');

            $('#modalKonfirmasi').modal('show');
          });
        });
      </script>