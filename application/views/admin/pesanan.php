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
            <div class="mb-4">
                <?= (!empty($filter)) ? '<h5>Menampilkan: </h5>' : ''; ?>
                <?= (!empty($filter['status'])) ? 'Status: ' . $filter['status'] : ''; ?>
                <?= (!empty($filter['dari'])) ? ', Dari tanggal: ' . $filter['dari'] : ''; ?>
                <?= (!empty($filter['sampai'])) ? ', Sampai: ' . $filter['sampai'] : ''; ?>
            </div>
            <form class="mb-4" action="<?= base_url('admin/pesanan/filter'); ?>" method="GET">
                <div class="row">
                    <div class="col-auto">
                        <div class="mt-2 font-weight-bold">Filter :</div>
                    </div>
                    <div class="col-3">
                        <select id="statusFilter" name="statusFilter" class="form-control" placeholder="Status Pesanan">
                            <option value="">-- Status Pesanan</option>
                            <option value="Belum Bayar" <?= (!empty($filter['status']) && $filter['status'] == 'Belum Bayar') ? 'selected' : ''; ?>>Belum Bayar</option>
                            <option value="Dibayar" <?= (!empty($filter['status']) && $filter['status'] == 'Dibayar') ? 'selected' : ''; ?>>Dibayar</option>
                            <option value="Diproses" <?= (!empty($filter['status']) && $filter['status'] == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                            <option value="Dikirim" <?= (!empty($filter['status']) && $filter['status'] == 'Dikirim') ? 'selected' : ''; ?>>Dikirim</option>
                            <option value="Selesai" <?= (!empty($filter['status']) && $filter['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <input name="dariTanggal" type="date" class="form-control" placeholder="Tanggal Pemesanan" value="<?= (!empty($filter['dari'])) ? $filter['dari'] : ''; ?>">
                    </div>
                    <div class="col-auto pt-2">
                        <div class="text-center">s/d</div>
                    </div>
                    <div class="col-auto">
                        <input name="keTanggal" type="date" class="form-control" placeholder="Tanggal Pemesanan" value="<?= (!empty($filter['sampai'])) ? $filter['sampai'] : ''; ?>">
                    </div>
                    <div class=" col-2">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>No. Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pesanan as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['id_pesanan']; ?></td>
                                <td><?= $p['name']; ?></td>
                                <td>Rp. <?= number_format($p['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <?php if ($p["status"] == 'Belum Bayar') : ?>
                                        <div class="badge badge-danger"><?= $p["status"]; ?></div>
                                    <?php elseif ($p["status"] == 'Dibayar') : ?>
                                        <div class="badge badge-warning"><?= $p["status"]; ?></div>
                                    <?php elseif ($p["status"] == 'Diproses') : ?>
                                        <div class="badge badge-info"><?= $p["status"]; ?></div>
                                    <?php elseif ($p["status"] == 'Dikirim') : ?>
                                        <div class="badge badge-secondary"><?= $p["status"]; ?></div>
                                    <?php elseif ($p["status"] == 'Selesai') : ?>
                                        <div class="badge badge-success"><?= $p["status"]; ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', $p['tgl_pesanan']); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/detail_pesanan/') . $p['id_pesanan']; ?>" class="btn btn-info btn-circle" title="Lihat Detail Pesanan">
                                        <i class="fas fa-list-alt"></i>
                                    </a>
                                    <button data-status="<?= $p['status']; ?>" data-id="<?= $p['id_pesanan']; ?>" class="btn btn-warning btn-circle" title="Ubah Status Pesanan" onclick="editData(this);" data-toggle="modal" data-target="#editModal">
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