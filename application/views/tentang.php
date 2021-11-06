<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
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
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Tentang Toko Makanan Khas</h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                    <a class="nav-link h3 text-primary mx-auto" href="<?= base_url(); ?>">
                      <div class="sidebar-brand-icon rotate-n-15 mb-4">
                        <i class="fa fa-store fa-3x"></i>
                      </div>
                      <div class="sidebar-brand-text mx-3"><b>Makanan Khas</b></div>
                    </a>
                  </div>
                   <p>Selamat datang di situs belanja online yang memberikan kemudahan,kecepatan dan kenyamanan bagi hidup anda,Praktis tidak perlu berpergian hanya untuk membeli kebutuhan anda, tidak perlu mengantri untuk berbelanja,tidak perlu bermacet macet di jalan. Hanya dengan memilih apa yang anda pesan kami akan mengantar ketempat anda berada,hemat biaya, hemat tenaga,praktis,cepat, kami siap melayani anda.</p>

                    <p>Hingga kini Toko makanan khas sudah mempunyai banyak pelanggan tetap dan terus bertambah dari waktu ke waktu.</p>

                    <p>
                        Kami menawarkan 2 pilihan untuk metode pembayaran. Pembayaran bisa dilakukan melalui bank transfer dan dompet digital. Setelah Anda memesan, Anda akan mendapatkan No. Pesanan untuk melacak status order Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>