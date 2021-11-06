<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Pesanan</h1>
    </div>

    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-sm-5">
            <div class="card shadow mb-4">
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Keranjang Belanja</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <?php $total = 0; ?>
                        <?php foreach ($keranjang as $k) : ?>
                            <div class="px-1 list-group-item list-group-item-action"><?= $k['nama_produk']; ?><b class="float-right">Rp. <?= number_format(($k["jumlah"] * $k['harga']), 0, ',', '.'); ?> / <?= $k['jumlah']; ?></b></div>
                            <?php $total += ($k['jumlah'] * $k['harga']) ?>
                        <?php endforeach; ?>
                        <div class="px-1 list-group-item list-group-item-action bg-light">
                            <b>Total : </b><b class="float-right">Rp. <?= number_format($total, 0, ',', '.'); ?>
                            </b>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="<?= base_url('keranjang'); ?>" class="btn btn-primary btn-sm mt-2 btn-block">Lihat Keranjang</a>
                    </div>
                </div>
            </div>
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
        <div class="col-sm">
            <div class="card shadow mb-4">
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Alamat Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="<?= base_url('pesan/tambah'); ?>" method="POST">
                                <?php $total_input = 0; ?>
                                <?php foreach ($keranjang as $k) : ?>
                                    <?php $total_input += ($k['jumlah'] * $k['harga']) ?>
                                <?php endforeach; ?>
                                <input id="Total" type="hidden" name="Total" value="<?= $total_input; ?>">
                                <div class="form-group">
                                    <label for="Nama">Nama</label>
                                    <input value="<?= $pelanggan->nama; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Nama" name="Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="Telepon">No Telepon</label>
                                    <input value="<?= $pelanggan->no_telp; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Telepon" name="Telepon" required>
                                </div>
                                <div class="form-group">
                                    <label for="Alamat">Alamat</label>
                                    <input value="<?= $pelanggan->alamat; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Alamat" name="Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="KodePos">Kode Pos</label>
                                    <input value="<?= $pelanggan->kode_pos; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="KodePos" name="KodePos" required>
                                </div>
                                <div class="form-group">
                                    <label for="Kota">Kota/Kabupaten</label>
                                    <input value="<?= $pelanggan->kota; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Kota" name="Kota" required>
                                </div>
                                <div class="form-group">
                                    <label for="Provinsi">Provinsi</label>
                                    <input value="<?= $pelanggan->provinsi; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Provinsi" name="Provinsi" required>
                                </div>
                                <hr class="navbar-divider">
                                <button type="submit" class="btn btn-primary float-right btn-block btn-lg" <?= count($keranjang) <= 0 ? 'disabled' : ''; ?>>Buat Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>

</script>