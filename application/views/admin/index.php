<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan'); ?>" class="nav-link p-0">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Semua Pesanan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pesanan; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan/filter?statusFilter=Belum+Bayar'); ?>" class="nav-link p-0">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                  Pesanan Belum Dibayar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_belum_bayar; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan/filter?statusFilter=Dibayar'); ?>" class="nav-link p-0">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                  Pesanan Dibayar</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_dibayar; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan/filter?statusFilter=Diproses'); ?>" class="nav-link p-0">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                  Pesanan Diproses</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_diproses; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan/filter?statusFilter=Dikirim'); ?>" class="nav-link p-0">
        <div class="card border-left-secondary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                  Pesanan Dikirim</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_dikirim; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pesanan/filter?statusFilter=Selesai'); ?>" class="nav-link p-0">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Pesanan Selesai</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pesanan_selesai; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/pembayaran'); ?>" class="nav-link p-0">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Pembayaran</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pembayaran; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <a href="<?= base_url('admin/produk'); ?>" class="nav-link p-0">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Produk
                </div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $total_produk; ?></div>
                  </div>
                  <div class="col">
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-box-open fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">

      <a href="<?= base_url('user/pelanggan'); ?>" class="nav-link p-0">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Pengguna</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_user; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Content Row -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->