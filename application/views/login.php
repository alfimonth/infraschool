<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= $this->config->item('app_name'); ?><?= isset($title) ? ' | ' . $title : ''; ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/favicon.ico') ?>" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url('public/css/styles.css') ?>?v=<?= time() ?>" rel="stylesheet" />
  <link href="<?= base_url('public/css/custom.css') ?>?v=<?= time() ?>" rel="stylesheet" />
</head>

<body class="bg-light d-flex flex-column min-vh-100">
  <a href="<?= base_url() ?>" class="text-center mt-3 fs-6">
    < Ke Home</a>
      <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            <form method="POST" action="<?= base_url('auth/login') ?>">
              <!-- Input NIP/NIS -->
              <div class="mb-3">
                <label for="nomor_induk" class="form-label">NIP/NIS</label>
                <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" placeholder="Masukkan NIP atau NIS" required>
                <?= form_error('nomor_induk', '<span class="margin-0 small text-danger">', '</span>') ?>
              </div>

              <!-- Input Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                <?= form_error('password', '<span class="margin-0 small text-danger">', '</span>') ?>
              </div>

              <!-- Button Login -->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <footer class="mt-auto bg-light py-3">
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
      </footer>

      <div class="container-xl px-4">
        <?php if ($this->session->flashdata('message')): ?>
          <div class="floating-alert alert alert-primary alert-icon position-fixed" role="alert">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="alert-icon-aside me-2">
                  <i class="bi bi-info-circle"></i>
                </div>
                <div class="alert-icon-content">
                  <i class="fas fa-info-circle"></i><?= ' ' . $this->session->flashdata('message'); ?>
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
              background-color: #e7f1ff;
              color: #084298;
              border: 1px solid #b6d4fe;
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
              background-color: #0d6efd;
              /* Warna biru Bootstrap */
            }

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
        <?php endif; ?>
      </div>


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