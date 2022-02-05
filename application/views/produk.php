<div class="container-fluid">

    <!-- Page Heading -->
    <?php if (!empty($kategori_pilih)) : ?>
        <div class="row mb-4">
            <div class="col text-center">
                <h3 class="h3 text-gray-800">Menampilkan Kategori : <?= $kategori_pilih->nama_kategori; ?></h3>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($cari_pilih)) : ?>
        <div class="row mb-4">
            <div class="col text-center">
                <h3 class="h3 text-gray-800">Menampilkan hasil pecarian : <?= $cari_pilih; ?></h3>
            </div>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="card shadow mb-4">
                <div class="card-body p-1">
                    <a class="nav-link" href="<?= base_url('keranjang'); ?>">
                        <span class="icon mr-3">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </span>
                        <span class="text"><b id="totalCart"><?= (!empty($totalCart)) ? $totalCart : 0; ?></b> Produk di keranjang anda.</span></a>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Kategori Produk</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php foreach ($kategori as $k) : ?>
                            <a href="<?= base_url('produk/kategori/') . $k['nama_kategori']; ?>" class="list-group-item list-group-item-action"><?= $k['nama_kategori']; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="card-columns">
                <?php foreach ($produk as $p) : ?>
                    <div class="card shadow mb-4">
                        <img src="<?= base_url('assets/img/produk/') . $p['gambar']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="<?= base_url('produk/lihat/') . $p['id_produk']; ?>" class="nav-link p-0">
                                <h5 class="card-title"><?= $p["nama_produk"]; ?></h5>
                            </a>
                            <h6 class="text-success font-weigth-bold">Rp. <?= number_format($p["harga"], 0, ',', '.'); ?> / <?= $p["nama_satuan"]; ?></h6>
                            <div class="text-center mt-4">
                                <a href="<?= base_url('keranjang/tambah/') . $p['id_produk']; ?>" class="btn btn-primary btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-cart-plus"></i>
                                    </span>
                                    <span class="text">Tambah ke keranjang</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

</div>