<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<?php include 'components/banner.php'; ?>
<!-- Main Content-->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <section class="row row-cols-1 row-cols-sm-2 row-cols-md-8 g-4">
        <?php foreach ($general_info as $info): ?>
          <div class="col-4 col-lg-2 d-flex flex-column align-items-center justify-content-start gap-2">
            <i data-feather="<?= $info['ikon'] ?>"></i>
            <span class="text-center"><?= $info['nilai'] . ' ' . $info['satuan'] ?></span>
          </div>
        <?php endforeach; ?>
        <script>
          feather.replace();
        </script>
      </section>
    </div>

    <!-- Pager-->
    <div class="clearfix"><a class="btn btn-primary float-right rounded" href="#!">Selengkapnya →</a></div>
  </div>
</div>
</div>