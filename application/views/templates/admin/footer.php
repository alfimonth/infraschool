<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

</div>
</main>
<footer class="footer-admin mt-auto footer-light">
  <div class="container-xl px-4">
    <div class="row">
      <div class="col-md-6 small">Copyright &copy; <?= $this->config->item('app_name') . ' ' . date('Y'); ?></div>
      <div class="col-md-6 text-md-end small">
        <a href="#!">Privacy Policy</a>
        &middot;
        <a href="#!">Terms &amp; Conditions</a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('public/admin/js/scripts.js') ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script> -->
<!-- <script src="<?= base_url('public/admin/assets/demo/chart-area-demo.js') ?>"></script> -->
<!-- <script src="<?= base_url('public/admin/assets/demo/chart-bar-demo.js') ?>"></script> -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= base_url('public/admin/js/datatables/datatables-simple-demo.js') ?>?v=<?= time() ?>"></script>
<script src=" https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
<script src="<?= base_url('public/admin/js/litepicker.js') ?>"></script>


</body>

</html>