<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
  <!-- Sidenav Toggle Button-->
  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
  <!-- Navbar Brand-->
  <!-- * * Tip * * You can use text or an image for your navbar brand.-->
  <!-- * * * * * * When using an image, we recommend the SVG format.-->
  <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
  <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html"><?= $this->config->item('app_name'); ?> Admin</a>
  <!-- Navbar Search Input-->
  <!-- * * Note: * * Visible only on and above the lg breakpoint-->

  <!-- Navbar Items-->
  <ul class="navbar-nav align-items-center ms-auto">
    <!-- Documentation Dropdown-->
    <li class="nav-item dropdown no-caret d-none d-md-block me-3">
      <a class="nav-link " id="navbarDropdownDocs" href="<?= base_url() ?>">
        <div class="fw-500">Home <?= $this->config->item('app_name'); ?></div>
      </a>
    </li>
    <!-- User Dropdown-->
    <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
      <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url('public/admin/assets/img/illustrations/profiles/profile-1.png') ?>" /></a>
      <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
        <h6 class="dropdown-header d-flex align-items-center">
          <img class="dropdown-user-img" src="<?= base_url('public/admin/assets/img/illustrations/profiles/profile-1.png') ?>" />
          <div class="dropdown-user-details">
            <div class="dropdown-user-details-name"><?= getProfile('fullname'); ?></div>
            <div class="dropdown-user-details-email"><?= getProfile('nomor_induk'); ?></div>
          </div>
        </h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" method="post">
          <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
      <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
          <!-- Sidenav Menu Heading (Account)-->
          <!-- * * Note: * * Visible only on and above the sm breakpoint-->
          <div class="sidenav-menu-heading d-sm-none">Account</div>
          <!-- Sidenav Link (Alerts)-->
          <!-- * * Note: * * Visible only on and above the sm breakpoint-->
          <a class="nav-link d-sm-none" href="#!">
            <div class="nav-link-icon"><i data-feather="bell"></i></div>
            Alerts
            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
          </a>
          <!-- Sidenav Link (Messages)-->
          <!-- * * Note: * * Visible only on and above the sm breakpoint-->
          <a class="nav-link d-sm-none" href="#!">
            <div class="nav-link-icon"><i data-feather="mail"></i></div>
            Messages
            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
          </a>
          <!-- Sidenav Menu Heading (Core)-->
          <br>
          <!-- Sidenav Accordion (Dashboard)-->
          <a class="nav-link <?= uri_string() == 'admin/dashboard' ? 'active' : "" ?>" href="<?= base_url('admin'); ?>">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Dashboards
          </a>
          <!-- Sidenav Heading (Custom)-->
          <div class="sidenav-menu-heading">Master Data</div>
          <a class="nav-link <?= strpos(uri_string(), 'general') !== false ? 'active' : "" ?>" href="<?= base_url('admin/general'); ?>">
            <div class="nav-link-icon"><i data-feather="globe"></i></div>
            General
          </a>
          <a class="nav-link <?= strpos(uri_string(), 'tahun_ajaran') !== false ? 'active' : "" ?>" href="<?= base_url('admin/tahun_ajaran'); ?>">
            <div class="nav-link-icon"><i data-feather="calendar"></i></div>
            Tahun Ajaran
          </a>
          <!-- Sidenav Accordion (Pages)-->

          <a class="nav-link collapsed <?= strpos(uri_string(), 'sarpras/') !== false ? 'active collapsed' : "" ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseSarpras" aria-expanded="false" aria-controls="collapseSarpras">
            <div class="nav-link-icon"><i data-feather="package"></i></div>
            Sarpras
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse <?= strpos(uri_string(), 'sarpras/') !== false ? 'show' : "" ?>" id="collapseSarpras" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <!-- Nested Sidenav Accordion (Pages -> Account)-->
              <a class="nav-link <?= uri_string() == 'sarpras/ruang' ? 'active' : "" ?>" href="<?= base_url('sarpras/ruang') ?>">
                Ruangan
              </a>
              <a class="nav-link <?= uri_string() == 'sarpras/peralatan' ? 'active' : "" ?>" href="<?= base_url('sarpras/peralatan') ?>">
                Peralatan
              </a>
              <a class="nav-link <?= uri_string() == 'sarpras/kategori' ? 'active' : "" ?>" href="<?= base_url('sarpras/kategori') ?>">
                Kategori
              </a>
            </nav>
          </div>
          <a class="nav-link collapsed <?= strpos(uri_string(), 'user/') !== false ? 'active collapsed' : "" ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="nav-link-icon"><i data-feather="user"></i></div>
            User
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse <?= strpos(uri_string(), 'user/') !== false ? 'show' : "" ?>" id="collapsePages" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
              <!-- Nested Sidenav Accordion (Pages -> Account)-->
              <a class="nav-link <?= uri_string() == 'user/admin' ? 'active' : "" ?>" href="<?= base_url('user/admin') ?>">
                Admin
              </a>
              <!-- Nested Sidenav Accordion (Pages -> Authentication)-->
              <a class="nav-link collapsed <?= strpos(uri_string(), 'user/anggota') !== false ? 'active collapsed' : "" ?>" href="<?= base_url('admin') ?>" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                Angggota
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
              </a>
              <div class="collapse <?= strpos(uri_string(), 'user/anggota') !== false ? 'show' : "" ?>" id="pagesCollapseAuth" data-bs-parent="#accordionSidenavPagesMenu">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesAuth">
                  <!-- Nested Sidenav Accordion (Pages -> Authentication -> Basic)-->
                  <a class="nav-link <?= uri_string() == 'user/anggota/guru' ? 'active' : "" ?>" href="<?= base_url('user/anggota/guru') ?>">
                    Guru

                  </a>

                  <!-- Nested Sidenav Accordion (Pages -> Authentication -> Social)-->
                  <a class="nav-link <?= uri_string() == 'user/anggota/siswa' ? 'active' : "" ?>" href="<?= base_url('user/anggota/siswa') ?>">
                    Siswa

                  </a>
                  <div class="collapse" id="pagesCollapseAuthSocial" data-bs-parent="#accordionSidenavPagesAuth">
                    <nav class="sidenav-menu-nested nav">
                      <a class="nav-link" href="auth-login-social.html">Login</a>
                      <a class="nav-link" href="auth-register-social.html">Register</a>
                      <a class="nav-link" href="auth-password-social.html">Forgot Password</a>
                    </nav>
                  </div>
                </nav>
              </div>

            </nav>
          </div>

          <!-- Sidenav Heading (UI Toolkit)-->
          <div class="sidenav-menu-heading">Transaksi</div>
          <!-- Sidenav Accordion (Layout)-->
          <a class="nav-link <?= uri_string() == 'transaksi/log' ? 'active' : "" ?>" href="<?= base_url('transaksi') ?>">
            <div class="nav-link-icon"><i data-feather="layout"></i></div>
            Log
          </a>
          <a class="nav-link <?= strpos(uri_string(), 'transaksi/peminjaman') !== false ? 'active collapsed' : "" ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
            <div class="nav-link-icon"><i data-feather="repeat"></i></div>
            Peminjaman
            <span class="badge bg-primary-soft text-primary ms-auto"><?= countAjuan() > 0 ? countAjuan() . " ajuan" : "" ?></span>
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

          </a>
          <div class="collapse <?= strpos(uri_string(), 'transaksi/peminjaman') !== false ? 'show' : "" ?>" id="collapseComponents" data-bs-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav">

              <a class="nav-link <?= uri_string() == 'transaksi/peminjaman/diajukan' ? 'active' : "" ?>" href="<?= base_url('transaksi/peminjaman/diajukan') ?>">
                Pengajuan

              </a>
              <a class="nav-link <?= uri_string() == 'transaksi/peminjaman/dipinjam' ? 'active' : "" ?>" href="<?= base_url('transaksi/peminjaman/dipinjam') ?>">Dalam Peminjaman</a>
              <a class="nav-link <?= uri_string() == 'transaksi/peminjaman/dikembalikan' ? 'active' : "" ?>" href="<?= base_url('transaksi/peminjaman/dikembalikan') ?>">Selesai</a>
              <a class="nav-link <?= uri_string() == 'transaksi/peminjaman/ditolak' ? 'active' : "" ?>" href="<?= base_url('transaksi/peminjaman/ditolak') ?>">Ditolak</a>
            </nav>
          </div>
          <!-- Sidenav Accordion (Components)-->

          <!-- Sidenav Heading (Addons)-->
          <div class="sidenav-menu-heading">Laporan</div>
          <!-- Sidenav Link (Charts)-->

          <!-- Sidenav Link (Tables)-->
          <a class="nav-link" href="tables.html">
            <div class="nav-link-icon"><i data-feather="printer"></i></div>
            Laporan Tahunan
          </a>
        </div>
      </div>
      <!-- Sidenav Footer-->
      <div class="sidenav-footer">
        <div class="sidenav-footer-content">
          <div class="sidenav-footer-subtitle">Login sebagai:</div>
          <div class="sidenav-footer-title"><?= getProfile('fullname'); ?></div>
        </div>
      </div>
    </nav>
  </div>