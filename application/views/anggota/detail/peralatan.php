<?php defined('BASEPATH') or exit('No direct script access allowed') ?>
<header class="masthead costum" class="bg-primary">
  <div class="overlay"></div>
  </div>
</header>

<style>
  header.costum {
    height: 4rem;
  }
</style>
<!-- Main Content-->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="container my-5">
        <div class="row">
          <!-- Gambar Ruangan -->
          <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
              <img
                src="<?= base_url('public/uploads/sarpras/peralatan/' . $tool['image']) ?>"
                alt="<?= $tool['jenis'] ?>"
                class="card-img-top rounded-top-4"
                style="object-fit: cover; height: 300px;">
            </div>
          </div>

          <!-- Detail Ruangan -->
          <div class="col-md-6">
            <h3 class="mb-3"><?= $tool['jenis'] ?></h3>

            <!-- Ukuran Ruangan -->

            <span class="badge bg-info rounded-pill py-2 px-3"><i class="fas fa-tags"></i> <?= $tool['kategori'] ?> <i class="fas fa-chevron-right"></i> <?= $tool['subkategori'] ?></span>
            <!-- Status Ketersediaan -->
            <p class="mb-3">
            <p class="mb-2">
              <strong>Jumlah:</strong>
            </p>

            <span class="badge bg-success"><i class="fas fa-check-circle"></i> <?= $tool['baik'] ?> Baik</span>
            <span class="badge bg-danger"><i class="fas fa-times-circle"></i> <?= $tool['rusak'] ?> Rusak</span>
            <span class="badge bg-warning text-dark"><i class="fas fa-retweet"></i> <?= $tool['dipinjam'] ?> Sedang Dipinjam</span>

            </p>

            <!-- Tombol Pinjam -->
            <?php if ($tool['baik'] - $tool['dipinjam'] > 0): ?>
              <form action="<?= base_url('pinjam/add_list/' . $tool['id']) ?>" method="POST">

                <div class="d-flex align-items-center gap-2 mb-3">
                  <!-- Tombol - -->
                  <span class="text-danger" onclick="decreaseQuantity()">
                    <i class="fas fa-minus"></i>
                  </span>

                  <input type="hidden" name="tipe" value="Peralatan">
                  <!-- Input Jumlah -->
                  <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    value="1"
                    min="1"
                    max="<?= $tool['baik'] - $tool['dipinjam'] ?>"
                    class="form-control text-center"
                    style="width: 60px;"
                    readonly>

                  <!-- Tombol + -->
                  <span class="text-success" onclick="increaseQuantity()">
                    <i class="fas fa-plus"></i>
                  </span>
                </div>

                <!-- Tombol Tambahkan -->
                <button type="submit" class="btn btn-primary rounded">
                  <i class="fas fa-list"></i> Tambahkan ke daftar pinjam
                </button>
              </form>
            <?php else: ?>
              <button class="btn btn-secondary rounded" disabled>
                <i class="fas fa-ban"></i> Tidak Tersedia
              </button>
            <?php endif; ?>

            <script>
              const maxQuantity = <?= $tool['baik'] - $tool['dipinjam'] ?>;
              const jumlahInput = document.getElementById('jumlah');

              function decreaseQuantity() {
                let currentValue = parseInt(jumlahInput.value, 10);
                if (currentValue > 1) {
                  jumlahInput.value = currentValue - 1;
                }
              }

              function increaseQuantity() {
                let currentValue = parseInt(jumlahInput.value, 10);
                if (currentValue < maxQuantity) {
                  jumlahInput.value = currentValue + 1;
                }
              }
            </script>

          </div>
        </div>
      </div>

    </div>

    <!-- Pager-->

  </div>
</div>
</div>