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
                Log
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
              <button id="tambahData" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddGeneral">Transaksi Baru</button>
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
          <a href="<?= base_url('export/logToExcel') ?>" class="btn btn-success mb-3"><i class="fas fa-file-excel me-2"></i>Excel </a>
          <a href="<?= base_url('export/logToPdf') ?>" class="btn btn-danger mb-3"><i class="fas fa-file-pdf me-2"></i>Pdf </a>
          <a href="<?= base_url('export/logPrint') ?>" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print me-2"></i>Print </a>
          <table id="datatablesSimple">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Sarpras</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>Oleh</th>
                <!-- <th>Aksi</th> -->
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              foreach ($logs as $log) : ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><?= date('d M Y - H:i', strtotime($log['tanggal'])) ?></td>
                  <td><?= $log['jenis_sarpras'] ?> </td>
                  <td>
                    <?php
                    $badgeColor = '';
                    switch ($log['tipe']) {
                      case 'masuk':
                        $badgeColor = 'primary'; // Hijau
                        break;
                      case 'keluar':
                        $badgeColor = 'danger'; // Merah
                        break;
                      case 'perbaikan':
                        $badgeColor = 'success'; // Kuning
                        break;
                      case 'rusak':
                        $badgeColor = 'warning'; // Abu-abu
                        break;
                      default:
                        $badgeColor = 'dark'; // Default warna
                    }
                    ?>
                    <div class="badge bg-<?= $badgeColor ?> text-white rounded-pill"><?= ucfirst($log['tipe']) ?></div>
                  </td>

                  <td><?= $log['jumlah'] ?> </td>
                  <td><?= $log['fullname'] ?> </td>
                  <!-- <td>
                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $log['id'] ?>">
                      <i data-feather="edit"></i>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                      data-id="<?= $log['id'] ?>"
                      data-jenis="<?= $log['fullname'] ?>"><i data-feather="trash-2"></i></button>
                  </td> -->
                </tr>
              <?php $index++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>


      <!-- Add Modal -->
      <div class="modal fade" id="modalAddGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="<?= base_url('transaksi/add_log') ?>" method="post" id="formGeneral">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Transaksi Baru</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="tipe">Jenis Transaksi</label>
                  <select class="form-control" name="tipe" id="tipe" type="text" placeholder="Masukkan jenis Informasi" required>
                    <option value="masuk">Masuk</option>
                    <option value="rusak">Rusak</option>
                    <option value="keluar">Keluar</option>
                    <option value="perbaikan">Perbaikan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="kategori_sarpras">Kategori Sarpras</label>
                  <select class="form-control" name="kategori_sarpras" id="kategori_sarpras" required>
                    <option value="Ruang" selected>Ruang</option>
                    <option value="Peralatan">Peralatan</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_sarpras">Jenis Sarpras</label>
                  <select class="form-control" name="id_sarpras" id="id_sarpras" required>
                    <?php foreach ($rooms as $room): ?>
                      <option
                        value="<?= $room['id'] ?>"
                        data-kategori="Ruang"
                        data-baik="<?= $room['baik'] ?>"
                        data-rusak="<?= $room['rusak'] ?>"
                        data-dipinjam="<?= $room['dipinjam'] ?>">
                        <?= $room['jenis'] ?>
                      </option>
                    <?php endforeach; ?>
                    <?php foreach ($tools as $tool): ?>
                      <option
                        value="<?= $tool['id'] ?>"
                        data-kategori="Peralatan"
                        data-baik="<?= $tool['baik'] ?>"
                        data-rusak="<?= $tool['rusak'] ?>"
                        data-dipinjam="<?= $tool['dipinjam'] ?>">
                        <?= $tool['jenis'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>

                </div>

                <script>
                  $(document).ready(function() {
                    const $kategoriDropdown = $('#kategori_sarpras');
                    const $sarprasDropdown = $('#id_sarpras');
                    const $sarprasOptions = $sarprasDropdown.find('option'); // Simpan semua opsi awal

                    // Fungsi untuk memfilter opsi berdasarkan kategori
                    function filterSarprasOptions() {
                      const selectedKategori = $kategoriDropdown.val();

                      // Sembunyikan semua opsi terlebih dahulu
                      $sarprasOptions.hide();

                      // Tampilkan opsi yang sesuai dengan kategori
                      $sarprasOptions.filter(`[data-kategori="${selectedKategori}"]`).show();

                      // Pilih opsi pertama yang ditampilkan secara default
                      $sarprasDropdown.val($sarprasOptions.filter(`[data-kategori="${selectedKategori}"]`).first().val());
                    }

                    // Jalankan filter saat halaman dimuat
                    filterSarprasOptions();

                    // Event listener untuk perubahan dropdown kategori
                    $kategoriDropdown.on('change', filterSarprasOptions);
                  });
                </script>
                <script>
                  $(document).ready(function() {
                    const $tipeDropdown = $('#tipe');
                    const $sarprasDropdown = $('#id_sarpras');
                    const $jumlahInput = $('#jumlah');
                    const $kategoriDropdown = $('#kategori_sarpras');

                    // Fungsi untuk menghitung max jumlah berdasarkan tipe transaksi dan opsi yang dipilih
                    function setMaxJumlah() {
                      const selectedTipe = $tipeDropdown.val();
                      const $selectedOption = $sarprasDropdown.find('option:selected'); // Ambil opsi yang dipilih

                      // Ambil data dari atribut data-* pada opsi yang dipilih
                      const baik = parseInt($selectedOption.data('baik')) || 0;
                      const rusak = parseInt($selectedOption.data('rusak')) || 0;
                      const dipinjam = parseInt($selectedOption.data('dipinjam')) || 0;

                      let maxJumlah = 0;
                      let minJumlah = 0;

                      if (selectedTipe === 'rusak') {
                        maxJumlah = baik - dipinjam;
                      } else if (selectedTipe === 'keluar') {
                        maxJumlah = baik - dipinjam; // Max jumlah = baik - dipinjam
                      } else if (selectedTipe === 'perbaikan') {
                        maxJumlah = rusak;
                      } else if (selectedTipe === 'masuk') {
                        maxJumlah = Infinity;
                        minJumlah = 1;
                        // Max jumlah = rusak
                      } else {
                        maxJumlah = Infinity; // Tidak ada batas untuk tipe lain
                      }

                      // Set atribut max pada input jumlah
                      $jumlahInput.attr('max', maxJumlah).val(Math.min($jumlahInput.val(), maxJumlah)); // Sesuaikan nilai jika lebih besar dari max

                      // Set atribut min pada input jumlah
                      $jumlahInput.attr('min', minJumlah).val(Math.max($jumlahInput.val(), minJumlah)); // Sesuaikan nilai jika lebih kecil dari min
                    }

                    // Event listener untuk perubahan tipe transaksi dan pilihan sarpras
                    $tipeDropdown.on('change', setMaxJumlah);
                    $sarprasDropdown.on('change', setMaxJumlah);
                    $kategoriDropdown.on('change', setMaxJumlah);

                    // Jalankan fungsi saat pertama kali form dimuat
                    setMaxJumlah();
                  });
                </script>


                <div class="mb-3">
                  <label for="jumlah">Jumlah Sarpras</label>
                  <input class="form-control" name="jumlah" id="jumlah" type="number" min="1" value="1" placeholder="Masukkan jumlah" required>
                  <span class="text-info">Max jumlah sudah disesuaikan dengan stok sarpras yang tersedia</span>
                </div>


                <div class="mb-3">
                  <label for="keterangan">Keterangan (Opsional)</label>
                  <input class="form-control" name="keterangan" id="keterangan" type="text" placeholder="Masukkan keterangan">
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
            const jenis = $(this).data('jenis');
            const value = $(this).data('value');
            const satuan = $(this).data('satuan');
            const ikon = $(this).data('ikon');

            // Isi data ke dalam form modal edit
            $('#jenis').val(jenis);
            $('#value').val(value);
            $('#satuan').val(satuan);
            $(`#ikon_${ikon}`).prop('checked', true);

            $('#formGeneral').attr('action', '<?= base_url('admin/edit_general/') ?>' + id);

            // Tampilkan modal edit
            $('#modalEditGeneral').modal('show');
          });

          $('#tambahData').on('click', function() {
            if (inputMode === 'edit') {
              inputMode = 'add';
              $('#jenis').val('');
              $('#value').val('');
              $('#satuan').val('');
              $(`#ikon_activity`).prop('checked', true);
              $('#formGeneral').attr('action', '<?= base_url('admin/add_general') ?>');
            }

            if (inputMode === 'unset') {
              inputMode = 'add';
              $(`#ikon_activity`).prop('checked', true);
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