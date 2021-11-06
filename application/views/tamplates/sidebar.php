    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-store fa-3x"></i>
        </div>
        <div class="sidebar-brand-text ml-4 text-capitalize">Makanan Khas</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- query menu -->
      <div class="sidebar-heading">
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('admin') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-box-open fa-3x"></i>
          <span>Produk</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/produk'); ?>">List Produk</a>
            <a class="collapse-item" href="<?= base_url('admin/kategori'); ?>">Kategori Produk</a>
            <a class="collapse-item" href="<?= base_url('admin/satuan'); ?>">Satuan Produk</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pesananMenu" aria-expanded="true" aria-controls="pesananMenu">
          <i class="fa fa-clipboard-list fa-3x"></i>
          <span>Pesanan</span>
        </a>
        <div id="pesananMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/pesanan'); ?>">List Pesanan</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pembayaranMenu" aria-expanded="true" aria-controls="pembayaranMenu">
          <i class="fa fa-credit-card fa-3x"></i>
          <span>Pembayaran</span>
        </a>
        <div id="pembayaranMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/rekening'); ?>">Pengaturan</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userMenu" aria-expanded="true" aria-controls="userMenu">
          <i class="fa fa-users fa-3x"></i>
          <span>User</span>
        </a>
        <div id="userMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('user/pelanggan'); ?>">Pelanggan</a>
            <a class="collapse-item" href="<?= base_url('user/admin'); ?>">Admin</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->