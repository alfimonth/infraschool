<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<header class="masthead costum bg-primary">
  <div class="overlay"></div>
</header>

<style>
  header.costum {
    height: 4rem;
  }

  .card-body {
    display: none;
    /* Set body awalnya tersembunyi */
  }

  .card-body.show {
    display: block;
    /* Tampilkan body jika tombol arrow ditekan */
  }

  .arrow-toggle {
    cursor: pointer;
    font-size: 1.5rem;
    transition: transform 0.3s;
  }

  .arrow-up {
    transform: rotate(180deg);
  }
</style>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="container my-5">
        <h3 class="mb-4">Riwayat Pinjam</h3>
        <?php if (empty($list)) : ?>
          <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle"></i> Belum ada riwayat peminjaman.
          </div>
        <?php else : ?>
          <?php foreach ($list as $index => $pinjam) : ?>
            <div class="card mb-4">
              <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Peminjaman #<?= $pinjam['id_pinjam'] . ' ' . $pinjam['catatan'];  ?></h5>
                  <!-- Menampilkan Status dengan Warna Berbeda -->
                  <span class="badge rounded-pill px-3 py-2
                        <?php switch ($pinjam['status']) {
                          case 'diajukan':
                            echo 'bg-warning';
                            break;
                          case 'ditolak':
                            echo 'bg-danger';
                            break;
                          case 'dipinjam':
                            echo 'bg-success';
                            break;
                          case 'dikembalikan':
                            echo 'bg-secondary';
                            break;
                          default:
                            echo 'bg-light';
                        }
                        ?>">
                    <?= $pinjam['status']; ?>
                  </span>
                  <!-- Tombol untuk Toggle Body -->

                </div>
                <div class="d-flex justify-content-between align-items-end">
                  <div class="mt-2 fs-6">
                    <p class="my-0"><strong>Tanggal Pinjam:</strong> <?= dmy($pinjam['tgl_pinjam']); ?></p>
                    <p class="my-0"><strong>Tanggal Pengembalian:</strong>
                      <?= $pinjam['tgl_kembali'] ? date('d-m-Y', strtotime($pinjam['tgl_kembali'])) : 'Belum Dikembalikan'; ?>
                    </p>
                  </div>
                  <div>
                    <span class="arrow-toggle float-end my-0 <?= $pinjam['status'] == 'dipinjam' ? 'arrow-up' : '' ?>"
                      onclick="toggleCardBody(<?= $pinjam['id_pinjam']; ?>)">
                      <i class="fas fa-angle-up"></i> <!-- Arrow Up -->
                    </span>
                  </div>

                </div>

              </div>


              <div class="card-body" id="card-body-<?= $pinjam['id_pinjam']; ?>">
                <!-- Pesan Jika Status Dipinjam -->


                <table class="table table-bordered">
                  <thead class="table-light text-center">
                    <tr>
                      <th>No</th>
                      <th>Nama Sarpras</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pinjam['list'] as $key => $item) : ?>
                      <tr>
                        <!-- No -->
                        <td class="text-center"><?= $key + 1; ?></td>
                        <!-- Nama Sarpras -->
                        <td><?= $item['nama_sarpras']; ?></td>
                        <!-- Jumlah -->
                        <td class="text-center"><?= $item['jumlah']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <?php if ($pinjam['status'] == 'dipinjam') : ?>
                  <div class="alert alert-info mt-2" role="alert">
                    <i class="fas fa-info-circle"></i> Segera ambil sarpras yang telah dipinjam jika belum diambil, dan kembalikan tepat waktu.
                  </div>
                <?php endif; ?>
                <?php if ($pinjam['status'] == 'diajukan') : ?>
                  <div class="alert alert-info mt-2" role="alert">
                    <i class="fas fa-info-circle"></i> Sedang menunggu konfirmasi admin. hubungi admin jika perlu.
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleCardBody(idPinjam) {
    const cardBody = document.getElementById('card-body-' + idPinjam);
    const arrowToggle = cardBody.previousElementSibling.querySelector('.arrow-toggle');

    // Toggle the visibility of the card body
    cardBody.classList.toggle('show');

    // Change the arrow direction
    if (cardBody.classList.contains('show')) {
      arrowToggle.classList.add('arrow-up');
    } else {
      arrowToggle.classList.remove('arrow-up');
    }
  }
</script>