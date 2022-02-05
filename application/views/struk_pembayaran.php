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
                <!-- <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Bukti Pembayaran</h5>
                </div> -->
                <div class="card-body">
                    <div class="text-center text-lg">
                        <div class="rotate-n-15">
                            <i class="fa fa-store fa-2x"></i>
                        </div><b>Makanan Khas</b>
                    </div>
                    <hr>
                    <h3 class="text-center font-weight-bold">Bukti Pembayaran</h3>
                    <div class="text-center"><b>No. Pesanan :</b> <?= $bukti->pesanan_id; ?></div>
                    <div class="row mb-2">
                        <div class="col">
                            <div><b>Pelanggan :</b></div>
                            <p><?= $bukti->name; ?></p>
                        </div>
                        <div class="col text-right">
                            <!-- <div><b>No. Pesanan :</b></div>
                            <p><?= $bukti->pesanan_id; ?></p> -->
                            <div><b>Tanggal :</b></div>
                            <p><?= date('d/m/Y', $bukti->tanggal_konfirmasi); ?></p>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <th>Nama Produk</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Subtotal</th>
                        </thead>
                        <tbody>
                            <?php
                            $this->db->join('tbl_produk', 'tbl_pesanan_detail.produk_id = tbl_produk.id_produk', 'left');
                            $this->db->where('pesanan_id', $bukti->pesanan_id);
                            $list = $this->db->get('tbl_pesanan_detail')->result();
                            foreach ($list as $l) :
                            ?>
                                <tr>
                                    <td><?= $l->nama_produk; ?></td>
                                    <td class="text-right">Rp. <?= number_format($l->harga, 0, ',', '.'); ?></td>
                                    <td class="text-right"><?= $l->jumlah; ?></td>
                                    <td class="text-right">Rp. <?= number_format($l->sub_total, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-right" colspan="3">Total :</th>
                                <th class="text-right">Rp. <?= number_format($bukti->total, 0, ',', '.'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="text-center">
                        Terima kasih telah melakukan pembayaran. Barang akan segera diproses dan dikirimkan dalam beberapa hari.
                    </div>
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