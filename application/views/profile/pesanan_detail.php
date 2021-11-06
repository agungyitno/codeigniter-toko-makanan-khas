<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow mb-4">
                        <div class="card-header text-primary">
                            <h5 class="p-0 m-0 font-weigth-bold">Informasi</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $this->db->where('pesanan_id', $pesanan->id_pesanan);
                            $bukti = $this->db->get('tbl_konfirmasi')->row();
                            ?>
                            <?php if ($pesanan->status == 'Belum Bayar') : ?>
                                <p class="font-weight-bold text-center">Segera lakukan pembayaran sebelum <br> <span class="text-lg"><?= date('d/m/Y H:i:s', $pesanan->batas_pembayaran); ?></span></p>
                                <div>Transfer pembayaran ke salah satu rekening dibawah ini agar pesanan segera diproses.</div>
                                <p>Sudah membayar ?, lakukan <a href="<?= base_url('pesan/konfirmasi'); ?>">Konfirmasi Pembayaran.</a></p>
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
                            <?php elseif ($pesanan->status == 'Diproses') : ?>
                                <p>Pesanan Sedang diproses. </p>
                                <a title="Lihat Bukti Pembayaran" href="<?= base_url('pesan/bukti_pembayaran/') . $bukti->id_konfirmasi; ?>" class="btn btn-primary btn-sm btn-block">
                                    Lihat Bukti Pembayaran
                                </a>
                            <?php elseif ($pesanan->status == 'Dibayar') : ?>
                                <p>Pembayaran sedang divalidasi. </p>
                                <a title="Lihat Bukti Pembayaran" href="<?= base_url('pesan/bukti_pembayaran/') . $bukti->id_konfirmasi; ?>" class="btn btn-primary btn-sm btn-block">
                                    Lihat Bukti Pembayaran
                                </a>
                            <?php elseif ($pesanan->status == 'Dikirim') : ?>
                                <p>Pesanan Sedang dalam perjalanan. </p><a title="Lihat Bukti Pembayaran" href="<?= base_url('pesan/bukti_pembayaran/') . $bukti->id_konfirmasi; ?>" class="btn btn-primary btn-sm btn-block">
                                    Lihat Bukti Pembayaran
                                </a>
                            <?php elseif ($pesanan->status == 'Selesai') : ?>
                                <p>Produk telah sampai tujuan dengan selamat. </p><a title="Lihat Bukti Pembayaran" href="<?= base_url('pesan/bukti_pembayaran/') . $bukti->id_konfirmasi; ?>" class="btn btn-primary btn-sm btn-block">
                                    Lihat Bukti Pembayaran
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header text-primary">
                            <h5 class="p-0 m-0 font-weigth-bold">Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm">
                                    <p>No. Pesanan : <b><?= $pesanan->id_pesanan; ?></b></p>
                                    <p>Pelanggan : <b><?= $pesanan->name; ?></b></p>
                                    <p>Nomor Telepon : <b><?= $pesanan->no_telp; ?></b></p>
                                    <p>Tanggal : <b><?= date('d/m/Y', $pesanan->tgl_pesanan); ?></b></p>
                                    <p>Status : <b><?= $pesanan->status; ?></b></p>
                                </div>
                                <div class="col-sm">
                                    <p>Nama Penerima : <b><?= $pesanan->nama_penerima; ?></b></p>
                                    <p>Alamat : <b><?= $pesanan->alamat; ?></b></p>
                                    <p>Kode Pos : <b><?= $pesanan->kode_pos; ?></b></p>
                                    <p>Kota : <b><?= $pesanan->kota; ?></b></p>
                                    <p>Provinsi : <b><?= $pesanan->provinsi; ?></b></p>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;  ?>
                                    <?php $total = 0;  ?>
                                    <?php foreach ($detail as $k) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $k["nama_produk"]; ?></td>
                                            <td>Rp. <?= number_format($k["harga"], 0, ',', '.'); ?></td>
                                            <td><?= $k["jumlah"]; ?></td>
                                            <td>Rp. <?= number_format($k["sub_total"], 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php $total += $k["sub_total"]; ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="4" class="font-weight-bold">Total</td>
                                        <td class="font-weight-bold">Rp. <?= number_format($total, 0, ',', '.'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>