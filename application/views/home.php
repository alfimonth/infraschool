<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<?php include 'components/banner.php'; ?>
<!-- Main Content-->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <section class="row row-cols-1 row-cols-sm-2 row-cols-md-8 g-4 mb-5">
        <?php foreach ($general_info as $info): ?>
          <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-start gap-2">
            <i data-feather="<?= $info['ikon'] ?>"></i>
            <span class="text-center"><?= $info['value'] . ' ' . $info['satuan'] ?></span>
          </div>
        <?php endforeach; ?>
        <script>
          feather.replace();
        </script>
      </section>
      <section class="my-5" id="rooms">
        <h1 class="text-primary fw-bold fs-3">Ruangan</h1>
        <div id="rooms" class="mb-5 row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <?php foreach ($rooms as $room): ?>
            <a href="<?= base_url('detail/room/' . $room['id']) ?>">

              <div class="card h-100 shadow-sm border-0">
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