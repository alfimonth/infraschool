<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<?php include 'components/banner.php'; ?>
<!-- Main Content-->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <section class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 mb-5">
        <?php foreach ($general_info as $info): ?>
          <div class="col d-flex flex-column align-items-center justify-content-start gap-2 text-center">
            <!-- Ikon -->
            <div class="icon-wrapper d-flex align-items-center justify-content-center rounded-circle bg-light p-3 shadow-sm" style="width: 60px; height: 60px;">
              <i data-feather="<?= $info['ikon'] ?>" class="icon-size" style="width: 24px; height: 24px;"></i>
            </div>

            <!-- Teks -->
            <div class="text-truncate fw-bold" style="max-width: 120px;" title="<?= $info['jenis'] ?>">
              <?= $info['jenis'] ?>
            </div>
            <div class="fw-light">
              <?= $info['value'] . ' ' . $info['satuan'] ?>
            </div>
          </div>
        <?php endforeach; ?>
        <script>
          feather.replace();
        </script>
      </section>

      <!-- Styling -->
      <style>
        .icon-size {
          color: #007bff;
          /* Warna ikon (biru Bootstrap) */
        }

        .icon-wrapper {
          transition: all 0.3s ease-in-out;
        }

        .icon-wrapper:hover {
          background-color: #007bff;
          /* Warna hover */
          color: #ffffff;
          /* Warna ikon pada hover */
        }

        .text-truncate {
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
      </style>
      <section class="my-5" id="rooms">
        <h1 class="text-primary fw-bold fs-3">Ruangan</h1>
        <div id="rooms" class="mb-5 row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <?php foreach ($rooms as $room): ?>
            <a class="mb-3" href="<?= base_url('detail/room/' . $room['id']) ?>">
              <div class="card h-100 shadow-sm border">
                <!-- Gambar Ruangan -->
                <div>
                  <div class="bg-primary bg-opacity-50 text-white px-2 py-1 fs-6">

                    <i class="fas fa-door-open"></i> <?= $room['baik'] ?> <?= $room['jenis'] ?>
                  </div>
                  <img class="card-img-top" src="<?= base_url('public/uploads/sarpras/ruang/' . $room['image']) ?>" alt="<?= $room['jenis'] ?>">

                </div>
              </div>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- <div class="clearfix"><a class="btn btn-primary rounded" href="#!">Selengkapnya →</a></div> -->
      </section>
      <section class="my-5" id="tools">
        <h1 class="text-primary fw-bold fs-3">Peralatan</h1>
        <div id="tools" class="mb-5 row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <?php foreach ($tools as $tool): ?>
            <a href="<?= base_url('detail/peralatan/' . $tool['id']) ?>">

              <div class="card h-100 shadow-sm border-0">
                <!-- Gambar Ruangan -->
                <div class="bg-primary bg-opacity-50 text-white px-2 py-1 fs-6">
                  <i class="fas fa-broom"></i> <?= $tool['baik'] ?> <?= $tool['jenis'] ?>
                </div>
                <img class="card-img-top" src="<?= base_url('public/uploads/sarpras/peralatan/' . $tool['image']) ?>" alt="<?= $room['jenis'] ?>">
              </div>

        </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- <div class="clearfix"><a class="btn btn-primary rounded" href="#!">Selengkapnya →</a></div> -->
    </section>
  </div>

  <!-- Pager-->

</div>
</div>
</div>