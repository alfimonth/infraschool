<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<!-- Footer -->

<hr />
<!-- Footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <ul class="list-inline text-center">
          <li class="list-inline-item">
            <a href="#!">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#!">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#!">
              <span class="fa-stack fa-lg">
                <i class="fas fa-circle fa-stack-2x"></i>
                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
              </span>
            </a>
          </li>
        </ul>
        <p class="copyright text-muted">Copyright &copy; <?= $this->config->item('app_name') . ' ' . date('Y') ?> </p>
      </div>
    </div>
  </div>
  <!-- to Top -->
</footer>
<?php include(APPPATH . 'views/components/to_top.php'); ?>


<!-- Bootstrap core JS-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?= base_url('vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="<?= base_url('public/js/scripts.js') ?>"></script>
<script src="<?= base_url('public/js/custom.js') ?>"></script>
</body>

</html>

<!-- Bootstrap JS -->