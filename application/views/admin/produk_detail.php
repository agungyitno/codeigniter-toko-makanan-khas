<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        </div>
        <div class="col text-right">
            <a href="<?= base_url('admin/produk'); ?>" id="kembali" class="btn btn-primary btn-icon-split mr-3">
                <span class="icon text-white-50">
                    <i class="fas fa-chevron-circle-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
            <button onclick="editData(this);" id="editData" class="btn btn-warning btn-icon-split mr-3" data-toggle="modal" data-target="#editModal" data-id="<?= $produk->id_produk; ?>" data-nama="<?= $produk->nama_produk; ?>" data-kategori="<?= $produk->kategori_id; ?>" data-satuan="<?= $produk->satuan_id; ?>" data-stok="<?= $produk->stok; ?>" data-harga="<?= $produk->harga; ?>" data-deskripsi="<?= $produk->deskripsi; ?>" data-gambar="<?= $produk->gambar; ?>">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Edit</span>
            </button>
            <button onclick="hapusData(this);" id="hapusData" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#hapusModal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Hapus</span>
            </button>
        </div>
    </div>


    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <img class="img-fluid img-thumbnail" src="<?= base_url('assets/img/produk/') . $produk->gambar; ?>" alt="<?= $produk->nama_produk; ?>">
                </div>
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><?= $produk->nama_produk; ?></h1>
                    <p class="text-lg">Kategori : <?= $produk->nama_kategori; ?></p>
                    <p class="text-lg">Stok : <?= $produk->stok; ?> <?= $produk->nama_satuan; ?></p>
                    <p class="text-lg">Harga : Rp. <?= number_format($produk->harga, 0, ',', '.'); ?> / <?= $produk->nama_satuan; ?></p>
                    <p class="text-lg">Deskripsi : <?= $produk->deskripsi; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $modelTitle; ?> : <span id="editNama"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" action="<?= base_url('admin/edit_produk'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idEdit" value="0">
                    <div class="form-group row">
                        <label class="col-sm-2" for="Nama">Nama Produk</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="text" class="form-control" id="NamaEdit" name="Nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Kategori">Kategori</label>
                        <div class="col-sm-10">
                            <select oninvalid="invalidInput(this)" class="form-control" name="Kategori" id="KategoriEdit" required>
                                <option value="" selected>-- Pilih Kategori</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Stok">Stok</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="number" class="form-control" id="StokEdit" name="Stok" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Satuan">Satuan</label>
                        <div class="col-sm-10">
                            <select oninvalid="invalidInput(this)" class="form-control" name="Satuan" id="SatuanEdit" required>
                                <option value="" selected>-- Pilih Satuan</option>
                                <?php foreach ($satuan as $s) : ?>
                                    <option value="<?= $s['id_satuan']; ?>"><?= $s['nama_satuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Harga">Harga</label>
                        <div class="col-sm-10">
                            <input oninvalid="invalidInput(this)" type="number" class="form-control" id="HargaEdit" name="Harga" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Deskripsi">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="Deskripsi" id="DeskripsiEdit" cols="3" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2" for="Gambar">Gambar</label>
                        <div class="col-sm-4">
                            <img src="<?= base_url('assets/img/produk/default.jpg'); ?>" id="imgPreviewEdit" alt="imgPreview" class="img-thumbnail">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="GambarEdit" name="Gambar" placeholder="Upload Gambar Produk">
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
                <form action="<?= base_url('admin/hapus_produk'); ?>" method="POST">
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

    GambarEdit.onchange = evt => {
        const [file] = GambarEdit.files
        if (file) {
            imgPreviewEdit.src = URL.createObjectURL(file)
        }
    }

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
        $('#KategoriEdit').val($(el).data('kategori')).change();
        $('#StokEdit').val($(el).data('stok'));
        $('#SatuanEdit').val($(el).data('satuan')).change();
        $('#HargaEdit').val($(el).data('harga'));
        $('#DeskripsiEdit').val($(el).data('deskripsi'));
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
</script>