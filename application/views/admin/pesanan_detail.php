<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col text-right">
            <!-- <?php if ($pesanan->status != 'Belum Bayar') : ?>
                <a href="<?= base_url('admin/pembayaran/') . $pesanan->id_pesanan; ?>" class="btn btn-success btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-credit-card"></i>
                    </span>
                    <span class="text">Pembayaran</span>
                </a>
            <?php endif; ?> -->
            <button data-id="<?= $pesanan->id_pesanan; ?>" data-status="<?= $pesanan->status; ?>" onclick="editData(this);" id="editData" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#editModal">
                <span class="icon text-white-50">
                    <i class="fas fa-pencil-alt"></i>
                </span>
                <span class="text">Ubah Status <?= $modelTitle; ?></span>
            </button>
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-sm-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <p>No. Pesanan : <b><?= $pesanan->id_pesanan; ?></b></p>
                            <p>Pelanggan : <b><?= $pesanan->name; ?></b></p>
                        </div>
                        <div class="col-sm">
                            <p>Tanggal : <b><?= date('d/m/Y', $pesanan->tgl_pesanan); ?></b></p>
                            <p>Status : <b><?= $pesanan->status; ?></b></p>
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
            <?php if(!empty($bukti)): ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- <div class="text-center text-lg">
                        <div class="rotate-n-15">
                            <i class="fa fa-store fa-2x"></i>
                        </div><b>Makanan Khas</b>
                    </div>
                    <hr> -->
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
                            <div><b>Tanggal pembayaran:</b></div>
                            <p><?= date('d/m/Y', $bukti->tanggal_konfirmasi); ?></p>
                        </div>
                    </div>
                    <div class="text-center">
                        <img src="<?= base_url('assets/img/pembayaran/').$bukti->bukti; ?>" class="img-thumbnail mw-100 px-4 py-4">
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5>Pengiriman</h5>
                    <hr class="navbar-divider">
                    <p>Nama Penerima:<br><span class="text-lg font-weight-bold"><?= $pesanan->nama_penerima; ?></span></p>
                    <p>Nomor Telepon:<br><span class="text-lg font-weight-bold"><?= $pesanan->no_telp; ?></span></p>
                    <p>Alamat:<br><span class="text-lg font-weight-bold"><?= $pesanan->alamat; ?></span></p>
                    <p>Kode Pos:<br><span class="text-lg font-weight-bold"><?= $pesanan->kode_pos; ?></span></p>
                    <p>Kota/Kabupaten:<br><span class="text-lg font-weight-bold"><?= $pesanan->kota; ?></span></p>
                    <p>Provinsi:<br><span class="text-lg font-weight-bold"><?= $pesanan->provinsi; ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status <?= $modelTitle; ?> : <span id="editNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/ubah_status_pesanan'); ?>" method="POST">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <div class="form-group row">
                        <div class="col-sm">
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Belum Bayar" type="radio" id="status1" name="Status" class="custom-control-input">
                                <label class="custom-control-label" for="status1">
                                    <h5><span class="badge badge-danger">Belum Bayar</span></h5>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Dibayar" type="radio" id="status2" name="Status" class="custom-control-input">
                                <label class="custom-control-label" for="status2">
                                    <h5><span class="badge badge-warning">Dibayar</span></h5>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Diproses" type="radio" id="status3" name="Status" class="custom-control-input">
                                <label class="custom-control-label" for="status3">
                                    <h5><span class="badge badge-info">Diproses</span></h5>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Dikirim" type="radio" id="status4" name="Status" class="custom-control-input">
                                <label class="custom-control-label" for="status4">
                                    <h5><span class="badge badge-secondary">Dikirim</span></h5>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Selesai" type="radio" id="status5" name="Status" class="custom-control-input">
                                <label class="custom-control-label" for="status5">
                                    <h5><span class="badge badge-success">Selesai</span></h5>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-icon-split float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editData(el) {
        $('#idEdit').val($(el).data('id'));
        $('input:radio[name=Status]').filter('[value="' + $(el).data('status') + '"]').prop('checked', 'true');
        $('#editNama').html($(el).data('id'));
        $('#editModal').on('shown.bs.modal', function(e) {
            $('#Status').focus();
        });
    }
</script>