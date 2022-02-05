<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col text-right">
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th>Validasi</th>
                            <th>Tgl Konfirmasi</th>
                            <th>Tgl Validasi</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pembayaran as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['pesanan_id']; ?></td>
                                <td><?= $p['name']; ?></td>
                                <td>Rp. <?= number_format($p['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($p["is_valid"] == 'Tidak') : ?>
                                        <div class="badge badge-danger"><?= $p["is_valid"]; ?></div>
                                    <?php elseif ($p["is_valid"] == 'Belum') : ?>
                                        <div class="badge badge-warning"><?= $p["is_valid"]; ?></div>
                                    <?php elseif ($p["is_valid"] == 'Valid') : ?>
                                        <div class="badge badge-success"><?= $p["is_valid"]; ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', $p['tanggal_konfirmasi']); ?></td>
                                <td><?= (!empty($p['tanggal_validasi'])) ? date('d/m/Y', $p['tanggal_validasi']) : '-'; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detail_pesanan/') . $p['id_pesanan']; ?>" class="btn btn-info btn-circle" title="Lihat Detail Pesanan">
                                        <i class="fas fa-list-alt"></i>
                                    </a>
                                    <button data-bukti="<?= base_url('assets/img/pembayaran/') . $p['bukti']; ?>" data-pesanan="<?= $p['pesanan_id']; ?>" data-status="<?= $p['is_valid']; ?>" data-id="<?= $p['id_konfirmasi']; ?>" class="btn btn-warning btn-circle" title="Validasi Pembayaran" onclick="editData(this);" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validasi Pembayaran Pesanan: <span id="editNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/pembayaran/validasi'); ?>" method="POST">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <img id="buktiImg" src="" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-sm">
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Valid" type="radio" id="validasi2" name="validasi" class="custom-control-input">
                                <label class="custom-control-label" for="validasi2">
                                    <h5><span class="badge badge-success">Valid</span></h5>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-sm-2">
                                <input value="Tidak" type="radio" id="validasi1" name="validasi" class="custom-control-input">
                                <label class="custom-control-label" for="validasi1">
                                    <h5><span class="badge badge-danger">Tidak</span></h5>
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
        $('#editNama').html($(el).data('pesanan'));
        $('#buktiImg').attr('src', $(el).data('bukti'));
        $('#editModal').on('shown.bs.modal', function(e) {
            $('#Status').focus();
        });
    }
</script>