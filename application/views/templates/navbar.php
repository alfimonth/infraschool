<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <style>
      .brand-logo {
        height: 1.5rem;
        margin-right: 0.5rem;
      }

      .navbar-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }

      .logo {
        width: 1.5rem;
        height: 1.5rem;
        background-image: url('<?= base_url(); ?>public/assets/img/is_white.png');
        background-size: cover;
      }

      #mainNav.is-fixed .navbar-brand .logo {
        background-image: url('<?= base_url(); ?>public/assets/img/is.png');
      }
    </style>
    <a class="navbar-brand" href="<?= base_url() ?>">
      <div class="logo"></div><?= $this->config->item('app_name'); ?>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">Ruangan</a></li>
        <li class="nav-item"><a class="nav-link" href="post.html">Peralatan</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>

        <?php if ($this->session->userdata('nomor_induk')) : ?>
          <?php if (getProfile('role') === 'admin') : ?>
            <li class="nav-item"><a class="nav-link bg-primary text-white rounded px-3" href="<?= base_url('admin') ?>">Admin<i class="fas fa-user ms-1"></i></a></li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link bg-primary text-white rounded px-3" href="<?= base_url('User') ?>">
                <?= getProfile('fullname') ?>
                <i class="fas fa-user ms-1"></i>
              </a>
            </li>
          <?php endif; ?>
        <?php else : ?>
          <li class="nav-item"><a class="nav-link bg-primary text-white rounded px-3" href="<?= base_url('auth/login') ?>">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>