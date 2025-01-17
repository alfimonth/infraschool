<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<header class="masthead costum bg-primary">
  <div class="overlay"></div>
</header>

<style>
  header.costum {
    height: 4rem;
  }
</style>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="container my-5">
        <h3 class="mb-4">Daftar Pinjam</h3>
        <?php if (empty($list)) : ?>
          <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle"></i> Daftar masih pinjam kosong.
            <hr>
            <a href="<?= base_url() ?>#rooms" class="btn btn-warning rounded mr-3">
              <i class="fas fa-plus"></i> Tambahkan sarpras
            </a>
          </div>
        <?php else : ?>
          <form action="<?= base_url('pinjam/pengajuan/') . $draft['id'] ?>" method="POST" id="pinjamForm">
            <table class="table align-middle">
              <thead class="table-primary text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Sarpras</th>
                  <th>Jumlah</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($list as $index => $item) :
                  if ($item['stok'] <= 0) {
                    redirect('pinjam/delete_list/' . $item['id']);
                  }
                ?>

                  <tr>
                    <!-- ID -->
                    <td class="text-center"><?= $index + 1 ?></td>

                    <!-- Nama Sarpras -->
                    <td><?= $item['nama_sarpras'] ?></td>

                    <!-- Jumlah -->
                    <td class="text-center">
                      <div class="d-flex justify-content-center align-items-center gap-2">
                        <!-- Tombol - -->
                        <span onclick="decreaseQuantity('jumlah-<?= $item['id'] ?>')">
                          <i class="fas fa-minus"></i>
                        </span>
                        <!-- Input Jumlah -->
                        <input
                          type="number"
                          name="jumlah[<?= $item['id'] ?>]"
                          id="jumlah-<?= $item['id'] ?>"
                          value="<?= $item['jumlah'] ?>"
                          min="1"
                          max="<?= $item['stok'] ?>"
                          class="form-control text-center jumlah-input"
                          style="width: 60px;"
                          data-initial="<?= $item['jumlah'] ?>"
                          oninput="checkChanges('jumlah-<?= $item['id'] ?>')">
                        <!-- Tombol + -->
                        <span onclick="increaseQuantity('jumlah-<?= $item['id'] ?>', <?= $item['stok'] ?>)">
                          <i class="fas fa-plus"></i>
                        </span>
                      </div>
                    </td>

                    <!-- Tombol Hapus -->
                    <td class="d-flex justify-content-end">
                      <!-- Tombol Cek -->
                      <a href="javascript:void(0)"
                        class="btn btn-success btn-sm rounded check-btn mr-2"
                        id="check-<?= $item['id'] ?>"
                        style="display: none;"
                        onclick="sendNewQuantity('<?= base_url('pinjam/edit_list/' . $item['id']) ?>', 'jumlah-<?= $item['id'] ?>')">
                        <i class="fas fa-check"></i>
                      </a>
                      <!-- Tombol Hapus -->
                      <a href="<?= base_url('pinjam/delete_list/' . $item['id']) ?>"
                        class="btn btn-danger btn-sm rounded">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="mb-3">
              <label for="tgl_kembali" class="form-label fw-bold fs-6">Tanggal Pengembalian</label>
              <input type="date" name="tgl_kembali" class="form-control" placeholder="Catatan" id="tgl_kembali" min="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="mb-3">
              <label for="catatan" class="form-label fw-bold fs-6">Catatan</label>
              <input type="text" name="catatan" class="form-control" placeholder="contoh: tujuan peminjaman" id="catatan">
            </div>
            <div class="alert alert-warning mt-2" role="alert">
              <i class="fas fa-info-circle"></i> Hanya isi field tanggal pengembalian dan catatan jika sudah yakin dengan jumlah sarpras yang dipinjam.
            </div>


            <!-- Tombol Pinjam -->
            <div class="d-flex justify-content-end mt-3">
              <a href="<?= base_url() ?>#rooms" class="btn btn-warning rounded mr-3">
                <i class="fas fa-plus"></i> Tambahkan sarpras
              </a>
              <button type="submit" class="btn btn-primary rounded" id="submitButton">
                <i class="fas fa-check"></i> Ajukan Pinjaman
              </button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  function decreaseQuantity(inputId) {
    const input = document.getElementById(inputId);
    let currentValue = parseInt(input.value, 10);
    if (currentValue > 1) {
      input.value = currentValue - 1;
      checkChanges(inputId);
    }
  }

  function increaseQuantity(inputId, maxValue) {
    const input = document.getElementById(inputId);
    let currentValue = parseInt(input.value, 10);
    if (currentValue < maxValue) {
      input.value = currentValue + 1;
      checkChanges(inputId);
    }
  }

  function sendNewQuantity(baseUrl, inputId) {
    // Ambil nilai terbaru dari input jumlah
    const newQuantity = document.getElementById(inputId).value;

    // Redirect ke URL dengan jumlah baru sebagai parameter query string
    window.location.href = `${baseUrl}?jumlah=${newQuantity}`;
  }

  function checkChanges(inputId) {
    const input = document.getElementById(inputId);
    const maxValue = parseInt(input.getAttribute('max'), 10); // Ambil stok maksimum dari atribut `max`
    const initialValue = input.getAttribute('data-initial');
    const checkButton = document.querySelector(`#check-${inputId.split('-')[1]}`);
    const submitButton = document.getElementById('submitButton');

    // Validasi jumlah melebihi stok
    if (parseInt(input.value, 10) > maxValue) {
      input.value = maxValue; // Batasi jumlah ke nilai stok maksimum
      alert('Jumlah tidak boleh melebihi stok yang tersedia!');
    }

    if (parseInt(input.value, 10) < 1) {
      input.value = 1; // Batasi jumlah ke nilai stok maksimum
      alert('Jumlah tidak boleh kurang dari 1!');
    }

    if (input.value == '') {
      input.value = 1; // Batasi jumlah ke nilai stok maksimum
      alert('Jumlah tidak boleh kurang dari 1!');
    }

    // Tampilkan tombol cek jika nilai berubah
    if (input.value !== initialValue) {
      checkButton.style.display = 'inline-block';
      submitButton.disabled = true; // Disable tombol ajukan pinjaman
    } else {
      checkButton.style.display = 'none';

      // Periksa jika tidak ada tombol cek yang aktif
      const activeChecks = document.querySelectorAll('.check-btn[style*="inline-block"]');
      if (activeChecks.length === 0) {
        submitButton.disabled = false; // Aktifkan tombol ajukan pinjaman
      }
    }
  }
</script>