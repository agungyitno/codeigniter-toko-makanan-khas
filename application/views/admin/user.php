<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col-sm-4">
            <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col-sm-8 text-right">
            <?php if ($modelTitle == 'Admin') : ?>
                <button onclick="tambahData();" id="tambahData" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah <?= $modelTitle; ?></span>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($data as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td class="text-center">
                                    <img width="64px" src="<?= base_url('assets/img/profile/') . $p['image']; ?>" alt="<?= $p['name']; ?>">
                                </td>
                                <td><?= $p['name']; ?></td>
                                <td><?= $p['email']; ?></td>
                                <td class="text-center"><button class="btn btn-<?= ($p['is_active'] == 1) ? 'success' : 'danger'; ?> btn-sm btn-icon-split" disabled>
                                        <span class="icon text-white-70">
                                            <i class="fas fa-user-<?= ($p['is_active'] == 1) ? 'check' : 'times'; ?>"></i>
                                        </span>
                                        <span class="text"><?= ($p['is_active'] == 1) ? 'Aktif' : 'Nonaktif'; ?></span>
                                    </button>
                                </td>
                                <td><?= date("d/m/Y", $p['date_created']); ?></td>
                                <td class="text-center">
                                    <button data-nama="<?= $p['name']; ?>" data-id="<?= $p['id']; ?>" data-status="<?= $p['is_active']; ?>" class="btn btn-warning btn-circle" title="Edit <?= $p['name']; ?>" onclick="editData(this);" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-nama="<?= $p['name']; ?>" data-id="<?= $p['id']; ?>" class="btn btn-danger btn-circle" title="Hapus Produk" onclick="hapusData(this);" data-toggle="modal" data-target="#hapusModal" <?= ($p['is_active'] == 1) ? 'disabled' : ''; ?>>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $modelTitle; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambah" action="<?= base_url('user/tambah_admin'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2" for="Nama">Nama</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="text" class="form-control" id="Nama" name="Nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Email">Email</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="email" class="form-control" id="Email" name="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Password">Password</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="password" class="form-control" id="Password" name="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Gambar">Foto</label>
                        <div class="col-sm-2">
                            <img src="<?= base_url('assets/img/profile/default.png'); ?>" id="imgPreview" width="100%" alt="imgPreview" class="img-thumbnail">
                        </div>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="Gambar" name="Gambar" placeholder="Upload Gambar Produk">
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
                <form id="formEdit" action="<?= base_url('user/edit/') . $modelTitle; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <?php if ($modelTitle == 'Admin') : ?>
                        <div class="form-group row">
                            <label class="col-sm-3" for="NamaEdit">Nama</label>
                            <div class="col-sm-9">
                                <input oninvalid="invalidInput(this)" type="text" class="form-control" id="NamaEdit" name="Nama" required>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group row">
                        <label class="col-sm-3" for="StatusEdit">Status</label>
                        <div class="col-sm-9">
                            <select oninvalid="invalidInput(this)" class="form-control" name="Status" id="StatusEdit" required>
                                <option value="" selected>-- Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3" for="PasswordEdit">Password</label>
                        <div class="col-sm-9">
                            <input oninvalid="invalidInput(this)" type="password" class="form-control" id="PasswordEdit" name="Password" placeholder="Biarkan kosong jika tidak ingin mengubah password.">
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
                <form action="<?= base_url('user/hapus_admin'); ?>" method="POST">
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
    Gambar.onchange = evt => {
        const [file] = Gambar.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    }



    function editData(el) {
        $('#NamaEdit').val($(el).data('nama'));
        $('#StatusEdit').val($(el).data('status')).change();
        $('#PasswordEdit').val($(el).data('stok'));
        $('#imgPreviewEdit').attr("src", "<?= base_url('assets/img/produk/'); ?>" + $(el).data('gambar'));
        $('#idEdit').val($(el).data('id'));
        $('#editNama').html($(el).data('nama'));
        $('#editModal').on('shown.bs.modal', function(e) {
            $('#NamaEdit').focus();
        });
    }

    function hapusData(el) {
        $('#idHapus').val($(el).data('id'));
        $('#hapusNama').html($(el).data('nama'));
    }

    function statusData(el) {
        $('#nonBtn').attr('href', '<?= base_url('user/nonaktifkan/'); ?>' + $(el).data('id'));
        $('#statusNama').html($(el).data('nama'));
    }



    function tambahData(el) {
        $('#tambahModal').on('shown.bs.modal', function(e) {
            $('#Nama').focus();
        });
    }
</script>