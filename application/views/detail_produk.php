<div class="container-fluid">

    <!-- Page Heading -->


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
                        <span class="text"><b id="totalCart">0</b> Produk di keranjang anda.</span></a>
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
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <img src="<?= base_url('assets/img/produk/') . $produk->gambar; ?>" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-sm-7">
                            <h3><?= $produk->nama_produk; ?></h3>
                            <h4 class="text-success">Rp. <?= number_format($produk->harga, 0, ',', '.'); ?> / <?= $produk->nama_satuan; ?></h4>
                            <h5>Stok tersedia: <?= $produk->stok; ?></h5>
                            <h5>Deskripsi : </h5>
                            <p><?= $produk->deskripsi; ?></p>
                            <a href="<?= base_url('keranjang/tambah/') . $produk->id_produk; ?>" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>
                                <span class="text">Tambah ke keranjang</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>