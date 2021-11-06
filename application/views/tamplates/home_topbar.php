<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <a class="navbar-brand d-flex text-primary" href="<?= base_url(); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><b>Makanan Khas</b></div>
            </a>

            <!-- Topbar Search -->
            <div class="topbar-divider d-none d-sm-block"></div>
            <form action="<?= base_url('produk/aksi_cari'); ?>" method="get" class="d-none d-sm-inline-block form-inline ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input name="cari" type="text" class="form-control bg-light border-1" placeholder="Cari Produk..." value="<?= (!empty($cari_pilih)) ? $cari_pilih : ''; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <?php if (!empty($user)) : ?>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="<?= base_url('pesan/konfirmasi'); ?>">Konfirmasi Pembayaran</a>
                    </li>
                <?php endif; ?>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="<?= base_url('tentang'); ?>">Tentang</a>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('keranjang'); ?>">
                        <i class="fas fa-shopping-cart fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter"><?= (!empty($totalCart)) ? $totalCart : 0; ?></span>
                    </a>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <?php if (!empty($user)) : ?>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <?php if ($user['role_id'] == 1) : ?>
                                <a class="dropdown-item" href="<?= base_url('admin'); ?>">
                                    <i class="fas fa-tachometer-alt fa-sm fa-fw mr-2 text-gray-500"></i>
                                    Dashboard
                                </a>
                                <div class="dropdown-divider"></div>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-500"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-500"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                <?php else : ?>
                    <div class="form-inline my-2 my-lg-0">
                        <a href="<?= base_url('auth'); ?>" class="btn btn-primary my-2 my-sm-0">Login</a>
                    </div>
                <?php endif; ?>

            </ul>

        </nav>