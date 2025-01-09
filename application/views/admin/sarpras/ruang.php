<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div id="layoutSidenav_content">
  <main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
      <div class="container-xl px-4">
        <div class="page-header-content">
          <div class="row align-items-center justify-content-between pt-3">
            <div class="col-auto mb-3">
              <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="globe"></i></div>
                Kelola Ruang
              </h1>
            </div>
            <div class="col-12 col-xl-auto mb-3">
              <button id="tambahData" class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddGeneral">Tambah Jenis Ruangan</button>
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
                <th>jenis Informasi</th>
                <th>Gambar</th>
                <th>Luas</th>
                <th>Tersedia</th>
                <th>Rusak</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $index = 1;
              foreach ($rooms as $room) : ?>
                <tr>
                  <td><?= $index ?></td>
                  <td><?= $room['jenis'] ?></td>
                  <td><img src="<?= base_url('public/uploads/sarpras/ruang/' . $room['image']) ?>" class="img-room" alt="gambar-<?= $room['jenis'] ?>"></td>
                  <td><?= $room['panjang'] ?> x <?= $room['lebar'] ?> m<sup>2</sup></td>
                  <td><?= $room['baik'] ?> </td>
                  <td><?= $room['rusak'] ?> </td>
                  <td>
                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $room['id'] ?>"
                      data-jenis="<?= $room['jenis'] ?>">
                      <i data-feather="plus"></i>
                    </button>
                    <button class="btn btn-datatable  btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $room['id'] ?>"
                      data-jenis="<?= $room['jenis'] ?>">
                      <i data-feather="minus"></i>
                    </button>
                    <button class="btn btn-datatable btn-icon btn-transparent-dark edit" data-bs-target="#modalAddGeneral" data-bs-toggle="modal"
                      data-id="<?= $room['id'] ?>"
                      data-jenis="<?= $room['jenis'] ?>"
                      data-image="<?= $room['image'] ?>"
                      data-panjang="<?= $room['panjang'] ?>"
                      data-lebar="<?= $room['lebar'] ?>"
                      data-kategori="<?= $room['id_kategori'] ?>">
                      <i data-feather="edit"></i>
                    </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      class="btn btn-datatable btn-icon btn-transparent-dark hapus"
                      data-id="<?= $room['id'] ?>"
                      data-jenis="<?= $room['jenis'] ?>"><i data-feather="trash-2"></i></button>
                  </td>
                </tr>
              <?php $index++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>


      <style>
        img.img-room {
          width: 2rem;
          height: 2rem;
          object-fit: cover;
          /* Memastikan gambar terpotong jika ukurannya tidak proporsional */
          display: block;
          /* Menghilangkan jarak bawah gambar (jika ada) */
        }
      </style>
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
            var u = '<?= base_url('sarpras/delete_ruang/') ?>';

            $('#dihapus').html(jenis);
            document.querySelector('#linkHapus').href = u + id;
          });
        });
      </script>


      <!-- Add Modal -->
      <div class="modal fade" id="modalAddGeneral" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <form action="<?= base_url('sarpras/add_ruang') ?>" method="post" id="formGeneral" enctype="multipart/form-data">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Ruangan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="jenis">Jenis Ruangan</label>
                  <input class="form-control" name="jenis" id="jenis" type="text" placeholder="Masukkan jenis ruangan" required>
                </div>
                <div class="mb-3 hidden" id="image-preview-container">
                  <label for="image" class="form-label">Gambar Saat Ini</label>
                  <img id="image-recent" class="img-room" alt="Image-Preview">
                </div>
                <style>
                  #image-preview-container.hidden {
                    display: none;
                  }

                  #image-preview-container>img {
                    width: 25%;
                    height: 25%;
                    object-fit: cover;
                    /* Memastikan gambar terpotong jika ukurannya tidak proporsional */
                    display: block;
                    /* Menghilangkan jarak bawah gambar (jika ada) */

                  }
                </style>
                <div class="mb-3">
                  <label for="image" class="form-label">Gambar</label>
                  <input class="form-control" name="image" id="image" type="file" placeholder="Masukkan gambar Informasi">
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="panjang" class="form-label">Panjang (m)</label>
                      <input class="form-control" name="panjang" id="panjang" type="text" placeholder="Masukkan panjang" required>
                    </div>
                    <div class="col-md-6">
                      <label for="lebar" class="form-label">Lebar (m)</label>
                      <input class="form-control" name="lebar" id="lebar" type="text" placeholder="Masukkan lebar" required>
                    </div>
                  </div>
                </div>


                <div class="mb-3">
                  <span class="form-label">Pilih Kategori</span>
                  <div class="icon-options">
                    <?php foreach ($categories as $category) : ?>
                      <input type="radio" class="form-check-input" name="id_kategori" id="kategori_<?= $category['id'] ?>" value="<?= $category['id'] ?>">
                      <label class="icon-label" for="kategori_<?= $category['id'] ?>">
                        <?= $category['nama'] ?>
                      </label>
                    <?php endforeach; ?>
                    <input type="radio" class="form-check-input" name="id_kategori" id="new_kategori" value="new">
                    <label class="icon-label" for="new_kategori">
                      <i data-feather="plus"></i>
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="kategori">Kategori baru</label>
                  <input class="form-control" name="new_kategori" id="kategori" type="text" placeholder="Masukkan kategori baru" disabled>
                </div>

                <script>
                  $(document).ready(function() {
                    // Event listener untuk perubahan radio button
                    $('input[name="id_kategori"]').on('change', function() {
                      if ($('#new_kategori').is(':checked')) {
                        // Aktifkan input field dan jadikan required
                        $('#kategori').prop('disabled', false).prop('required', true);
                      } else {
                        // Nonaktifkan input field dan hapus required
                        $('#kategori').prop('disabled', true).prop('required', false).val('');
                      }
                    });
                  });
                </script>

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
            $('#exampleModalCenterTitle').text('Edit Ruangan');
            const id = $(this).data('id');
            const jenis = $(this).data('jenis');
            const image = $(this).data('image');
            const panjang = $(this).data('panjang');
            const lebar = $(this).data('lebar');
            const kategori = $(this).data('kategori');

            // Isi data ke dalam form modal edit
            $('#jenis').val(jenis);
            $('#image-preview-container').removeClass('hidden');
            $('#image-recent').attr('src', '<?= base_url('public/uploads/sarpras/ruang/') ?>' + image);
            $('#panjang').val(panjang);
            $('#lebar').val(lebar);

            $(`#kategori_${kategori}`).prop('checked', true);

            $('#formGeneral').attr('action', '<?= base_url('sarpras/edit_ruang/') ?>' + id);

            // Tampilkan modal edit
            $('#modalEditGeneral').modal('show');
          });

          $('#tambahData').on('click', function() {
            if (inputMode === 'edit') {
              inputMode = 'add';
              $('#exampleModalCenterTitle').text('Tambah Ruangan');
              $('#jenis').val('');
              $('#value').val('');
              $('#satuan').val('');
              $(`#kategori_1`).prop('checked', true);
              $('#formGeneral').attr('action', '<?= base_url('sarpras/add_ruang') ?>');
              $('#image-preview-container').addClass('hidden');
            }

            if (inputMode === 'unset') {
              inputMode = 'add';
              $(`#kategori_1`).prop('checked', true);
            }
          });

        });
      </script>