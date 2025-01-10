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
      <section>
        <h1>Ruang</h1>
        <div id="rooms" class="mb-5 row row-cols-1 row-cols-sm-2 row-cols-md-8 g-4">
          <?php foreach ($rooms as $room): ?>
            <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-start gap-2">
              <img class="w-100" src="<?= base_url('public/uploads/sarpras/ruang/' . $room['image']) ?>" alt="">
              <span class="text-center"><?= $room['jenis'] ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="clearfix"><a class="btn btn-primary rounded" href="#!">Selengkapnya →</a></div>
      </section>
      <section class="my-5">
        <h1>Peralatan</h1>
        <div id="rooms" class="mb-5 row row-cols-1 row-cols-sm-2 row-cols-md-8 g-4">
          <?php foreach ($tools as $tool): ?>
            <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-start gap-2">
              <img class="w-100" src="<?= base_url('public/uploads/sarpras/peralatan/' . $tool['image']) ?>" alt="">
              <span class="text-center"><?= $tool['jenis'] ?></span>
            </div>

          <?php endforeach; ?>
        </div>

        <div class="clearfix"><a class="btn btn-primary rounded" href="#!">Selengkapnya →</a></div>
      </section>
    </div>

    <!-- Pager-->

  </div>
</div>
</div>