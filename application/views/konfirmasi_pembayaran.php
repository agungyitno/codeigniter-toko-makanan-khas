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
        <div class="col-sm-5">

            <div class="card shadow mb-4">
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Konfirmasi Pembayaran</h5>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('pesan/confirm'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="id">Kode Pesanan</label>
                            <select oninvalid="invalidInput(this)" class="form-control" id="id" name="id" required>
                                <?php if (count($pesanan) > 0) : ?>
                                    <option value="">-- Pilih Pesanan</option>
                                <?php else : ?>
                                    <option value="">-- Belum ada Pesanan</option>
                                <?php endif; ?>
                                <?php foreach ($pesanan as $p) : ?>
                                    <option value="<?= $p['id_pesanan'] ?>"><?= $p['id_pesanan'] ?> | Rp. <?= number_format($p['total'], 0, ',', '.'); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Bukti">Bukti Pembayaran</label>
                            <input oninvalid="invalidInput(this)" accept="image/*" type="file" class="form-control" id="Bukti" name="Bukti" required>
                        </div>
                        <img class="img-thumbnail" id="BuktiImg" src="#" alt="">
                        <hr class="navbar-divider">
                        <button type="submit" class="btn btn-primary float-right btn-block btn-lg">Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm">

                    <div class="card shadow mb-4">
                        <div class="card-header text-primary">
                            <h5 class="p-0 m-0 font-weigth-bold">Metode Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <p>Transfer pembayaran ke salah satu rekening dibawah ini.</p>
                                <div class="row">
                                    <div class="col-sm">
                                        <p class="text-lg"><b>Bank</b></p>
                                        <div class="list-group">
                                            <?php foreach ($pembayaran as $p) : ?>
                                                <?php if ($p['jenis'] == 'BANK') : ?>
                                                    <div class="list-group-item list-group-item-action">
                                                        <b><?= $p['nama']; ?></b>
                                                        <div><?= $p['nomor']; ?></div>
                                                        <div><?= $p['atas_nama']; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <p class="text-lg"><b>Dompet Digital</b></p>
                                        <div class="list-group">
                                            <?php foreach ($pembayaran as $p) : ?>
                                                <?php if ($p['jenis'] == 'EWALLET') : ?>
                                                    <div class="list-group-item list-group-item-action">
                                                        <b><?= $p['nama']; ?></b>
                                                        <div><?= $p['nomor']; ?></div>
                                                        <div><?= $p['atas_nama']; ?></div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    Bukti.onchange = evt => {
        const [file] = Bukti.files
        if (file) {
            BuktiImg.src = URL.createObjectURL(file)
        }
    }
</script>