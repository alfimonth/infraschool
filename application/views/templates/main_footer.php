<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<!-- Footer -->

<hr />
<!-- Footer-->
<footer id="contact">
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
<div class="container-xl px-4">
  <?php
  // Daftar warna berdasarkan tipe flashdata
  $flashTypes = [
    'success' => ['class' => 'alert-success', 'icon' => 'bi-check-circle'],
    'error'   => ['class' => 'alert-danger', 'icon' => 'bi-x-circle'],
    'info'    => ['class' => 'alert-primary', 'icon' => 'bi-info-circle'],
    'warning' => ['class' => 'alert-warning', 'icon' => 'bi-exclamation-triangle']
  ];

  foreach ($flashTypes as $type => $style) :
    if ($this->session->flashdata($type)) :
  ?>
      <div class="floating-alert alert <?= $style['class'] ?> alert-icon position-fixed" role="alert">
        <div class="d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <div class="alert-icon-aside me-2">
              <i class="<?= $style['icon'] ?>"></i>
            </div>
            <div class="alert-icon-content">
              <?= ' ' . $this->session->flashdata($type); ?>
            </div>
          </div>
          <button class="btn-close ms-2" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- Loading bar -->
        <div class="loading-bar"></div>
      </div>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
          const alertElement = document.querySelector('.floating-alert');
          const loadingBar = alertElement.querySelector('.loading-bar');

          // Jalankan loading bar
          loadingBar.style.transition = "width 2s linear";
          loadingBar.style.width = "100%";

          // Tutup alert setelah 4 detik
          setTimeout(function() {
            alertElement.style.transition = "opacity 0.5s ease-out";
            alertElement.style.opacity = 0;
            setTimeout(() => alertElement.remove(), 500); // Hapus elemen setelah fade-out selesai
          }, 2000);
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
          position: fixed;
          border-radius: 0.375rem;
          padding: 1rem;
        }

        /* Loading bar */
        .loading-bar {
          position: absolute;
          bottom: 0;
          left: 0;
          height: 4px;
          width: 0;
        }

        /* Warna Loading Bar berdasarkan tipe flash */
        .alert-success .loading-bar {
          background-color: #198754;
        }

        /* Hijau */
        .alert-danger .loading-bar {
          background-color: #dc3545;
        }

        /* Merah */
        .alert-primary .loading-bar {
          background-color: #0d6efd;
        }

        /* Biru */
        .alert-warning .loading-bar {
          background-color: #ffc107;
        }

        /* Kuning */

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
  <?php
    endif;
  endforeach;
  ?>
</div>

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