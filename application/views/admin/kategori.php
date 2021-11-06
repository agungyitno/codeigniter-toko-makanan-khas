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
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kategori as $k) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $k['nama_kategori']; ?></td>
                                <td>
                                    <button data-nama="<?= $k['nama_kategori']; ?>" data-id="<?= $k['id_kategori']; ?>" class="btn btn-info btn-circle" title="Edit" onclick="editData(this);" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button data-nama="<?= $k['nama_kategori']; ?>" data-id="<?= $k['id_kategori']; ?>" class="btn btn-danger btn-circle" title="Hapus" onclick="hapusData(this);" data-toggle="modal" data-target="#hapusModal">
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
                <form action="<?= base_url('admin/tambah_kategori'); ?>" method="POST">
                    <div class="form-group">
                        <label for="Nama">Nama Kategori</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="Nama" name="Nama" required>
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
                <form action="<?= base_url('admin/edit_kategori'); ?>" method="POST">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <div class="form-group">
                        <label for="NamaEdit">Nama Kategori</label>
                        <input oninvalid="invalidInput(this)" type="text" class="form-control" id="NamaEdit" name="Nama" value="" required>
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
                <form action="<?= base_url('admin/hapus_kategori'); ?>" method="POST">
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
    function invalidInput(el) {
        $(el).addClass('is-invalid');
        $(el).attr('oninput', 'startInput(this)');
        var id = $(el).attr('id');
        var label = $('label[for="' + id + '"]');
        $('.invalid-' + id).remove();
        $(el).after('<div class="invalid-feedback invalid-' + id + '">\
                        Harap masukkan ' + label.html() + '!\
                    </div>')
    }

    function startInput(el) {
        $(el).removeClass('is-invalid');
    }

    function editData(el) {
        $('#NamaEdit').val($(el).data('nama'));
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

    function tambahData(el) {
        $('#Nama').val('');
        $('#tambahModal').on('shown.bs.modal', function(e) {
            $('#Nama').focus();
        });
    }
</script>