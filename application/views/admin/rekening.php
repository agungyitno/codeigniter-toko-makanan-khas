<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col">
        </div>
        <div class="col text-right">
            <button onclick="tambahData();" id="tambahData" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah <?= $modelTitle; ?></span>
            </button>
        </div>
    </div>

    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Atas Nama</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($rekening as $k) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $k['jenis']; ?></td>
                                <td><?= $k['nama']; ?></td>
                                <td><?= $k['nomor']; ?></td>
                                <td><?= $k['atas_nama']; ?></td>
                                <td>
                                    <button data-nama="<?= $k['nama']; ?>" data-id="<?= $k['id_pembayaran']; ?>" data-jenis="<?= $k['jenis']; ?>" data-nomor="<?= $k['nomor']; ?>" data-atas_nama="<?= $k['atas_nama']; ?>" class="btn btn-info btn-circle" title="Edit" onclick="editData(this);" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button data-nama="<?= $k['nama']; ?>" data-id="<?= $k['id_pembayaran']; ?>" class="btn btn-danger btn-circle" title="Hapus" onclick="hapusData(this);" data-toggle="modal" data-target="#hapusModal">
                                        <i class="fas fa-trash"></i>
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
<div id="tambahModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $modelTitle; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/rekening/tambah'); ?>" method="POST">
                    <div class="form-group">
                        <label for="Jenis">Jenis</label>
                        <select oninvalid="invalidInput(this)" class="form-control" id="Jenis" name="Jenis" required>
                            <option value="">-- Jenis Rekening</option>
                            <option value="BANK">BANK</option>
                            <option value="EWALLET">EWALLET</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="Nama" name="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="Nomor">Nomor Rekening</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="Nomor" name="Nomor" required>
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Atas Nama</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="atas_nama" name="atas_nama" required>
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
<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $modelTitle; ?> : <span id="editNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/rekening/edit'); ?>" method="POST">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <div class="form-group">
                        <label for="JenisEdit">Jenis</label>
                        <select oninvalid="invalidInput(this)" class="form-control" id="JenisEdit" name="Jenis" required>
                            <option value="">-- Jenis Rekening</option>
                            <option value="BANK">BANK</option>
                            <option value="EWALLET">EWALLET</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="NamaEdit">Nama</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="NamaEdit" name="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="NomorEdit">Nomor Rekening</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="NomorEdit" name="Nomor" required>
                    </div>
                    <div class="form-group">
                        <label for="atas_namaEdit">Atas Nama</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="atas_namaEdit" name="atas_nama" required>
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
<div id="hapusModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <?= $modelTitle; ?> : <span id="hapusNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('admin/rekening/hapus'); ?>" method="POST">
                    <input type="hidden" name="id" id="idHapus" value="0">
                    <button class="btn btn-secondary mr-3 btn-icon-split" type="button" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fas fa-times"></i>
                        </span>
                        <span class="text">Batal</span></button>
                    <button type="submit" class="btn btn-danger btn-icon-split float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function editData(el) {
        $('#NamaEdit').val($(el).data('nama'));
        $('#JenisEdit').val($(el).data('jenis'));
        $('#NomorEdit').val($(el).data('nomor'));
        $('#atas_namaEdit').val($(el).data('atas_nama'));
        $('#idEdit').val($(el).data('id'));
        $('#editNama').html($(el).data('nama'));
        $('#editModal').on('shown.bs.modal', function(e) {
            $('#JenisEdit').focus();
        });
    }

    function hapusData(el) {
        $('#idHapus').val($(el).data('id'));
        $('#hapusNama').html($(el).data('nama'));
    }

    function tambahData(el) {
        $('#Nama').val('');
        $('#tambahModal').on('shown.bs.modal', function(e) {
            $('#Jenis').focus();
        });
    }
</script>