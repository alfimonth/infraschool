<div id="layoutSidenav_content">
  <main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
      <div class="container-xl px-4">
        <div class="page-header-content pt-4">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto mt-4">
              <h1 class="page-header-title">
                <div class="page-header-icon"><i data-feather="activity"></i></div>
                Dashboard
              </h1>
              <div class="page-header-subtitle">Example dashboard overview and content summary</div>
            </div>
            <div class="col-12 col-xl-auto mt-4">
              <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                <span class="input-group-text d-flex gap-2"><i class="text-primary" data-feather="calendar"></i>
                  Tahun Ajaran <?= getTahunAjaran(); ?>
                </span>

              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
      <div class="row">
        <!-- top -->
        <div class="row">
          <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-info text-white h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="me-3">
                    <div class="text-white-75 small">Ruangan</div>
                    <div class="text-lg fw-bold"><?= $this->db->select_sum('baik')->get('ruang')->row()->baik; ?></div>
                  </div>
                  <i class="feather-xl text-white-50" data-feather="home"></i>
                </div>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="<?= base_url('sarpras/ruang'); ?>">Lihat Ruangan</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-warning text-white h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="me-3">
                    <div class="text-white-75 small">Peralatan</div>
                    <div class="text-lg fw-bold"><?= $this->db->select_sum('baik')->get('peralatan')->row()->baik; ?></div>
                  </div>
                  <i class="feather-xl text-white-50" data-feather="tool"></i>
                </div>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="<?= base_url('sarpras/peralatan'); ?>">Lihat Peralatan</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-success text-white h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="me-3">
                    <div class="text-white-75 small">Anggota</div>
                    <div class="text-lg fw-bold"><?= $this->db->where('role', 'anggota')->count_all_results('user'); ?></div>
                  </div>
                  <i class="feather-xl text-white-50" data-feather="user"></i>
                </div>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="<?= base_url('user/anggota/guru'); ?>">Lihat Anggota</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="me-3">
                    <div class="text-white-75 small">Peminjaman</div>
                    <div class="text-lg fw-bold"><?= $this->db->where('status', 'dipinjam')->count_all_results('pinjam'); ?></div>
                  </div>
                  <i class="feather-xl text-white-50" data-feather="repeat"></i>
                </div>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="<?= base_url('transaksi/peminjaman/dipinjam'); ?>">Lihat Peminjaman</a>
                <div class="text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
        </div>

        
      </div>


    <!-- Example Colored Cards for Dashboard Demo-->

    <!-- Example Charts for Dashboard Demo-->

    <!-- Example DataTable for Dashboard Demo-->