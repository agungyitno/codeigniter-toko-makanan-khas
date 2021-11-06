<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
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
        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header text-primary">
                    <h5 class="p-0 m-0 font-weigth-bold">Keranjang Belanja</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($keranjang) > 0) : ?>
                                <?php $no = 1;  ?>
                                <?php $grandtotal = 0; ?>
                                <?php foreach ($keranjang as $k) : ?>

                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $k["nama_produk"]; ?></td>
                                        <td id="harga" data-harga="<?= $k['harga']; ?>">Rp. <?= number_format($k["harga"], 0, ',', '.'); ?></td>
                                        <td style="width: 20%;">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <button data-id="<?= $k['id_keranjang']; ?>" onclick="kurangijml(this);" class="btn btn-primary btn-sm" type="button" id="btnMin"><i class="fas fa-minus"></i></button>
                                                </div>
                                                <input id="<?= $k['id_keranjang']; ?>" class="jumlah form-control form-control-sm text-center" type="text" value="<?= $k['jumlah']; ?>" readonly>
                                                <div class="input-group-append">
                                                    <button data-id="<?= $k['id_keranjang']; ?>" onclick="tambahjml(this);" class="btn btn-primary btn-sm" type="button" id="btnPlus"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp. <?= number_format(($k["jumlah"] * $k['harga']), 0, ',', '.'); ?></td>

                                        <td>
                                            <a href="<?= base_url('keranjang/hapus/') . $k["id_keranjang"]; ?>"><button class="btn btn-danger btn-sm float-right"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>

                                    <?php $grandtotal += ($k["jumlah"] * $k['harga']); ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="text-right" colspan="6"><button onclick="updateCart()" id="updateKeranjang" class="btn btn-primary btn-sm disabled" disabled>Update Keranjang</button></td>
                                </tr>
                            <?php else : ?>
                                <?php $grandtotal = 0; ?>
                                <tr>
                                    <td class="text-center" colspan="6"><b>Keranjang belanja kosong!</b></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-6 mb-4"><a href="<?= base_url('produk'); ?>" class="btn btn-primary">Lanjut belanja</a></div>
                        <div class="col-sm-6 text-right">
                            <h4 class="text-left">Total Keranjang</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-left"><b>Total</b></td>
                                    <td>Rp. <?= number_format($grandtotal, 0, ',', '.'); ?></td>
                                </tr>
                            </table>
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">

                                    <a href="<?= base_url('pesan/invoice'); ?>" class="btn btn-primary btn-block">Selanjutnya</a>
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
    var idSend = [];
    var qtySend = [];

    function tambahjml(el) {
        $('#updateKeranjang').removeClass('disabled');
        $('#updateKeranjang').removeAttr('disabled');
        var prev = $('#' + $(el).data('id')).val();
        $('#' + $(el).data('id')).val(parseInt(prev) + 1);
        var krjid = parseInt($(el).data('id'));
        var krjjumlah = parseInt($('#' + $(el).data('id')).val());
        if (idSend.includes(krjid)) {
            qtySend[idSend.findIndex(el => el == krjid)] = krjjumlah;
        } else {
            idSend.push(krjid);
            qtySend.push(krjjumlah);

        }
    }

    function kurangijml(el) {
        $('#updateKeranjang').removeClass('disabled');
        $('#updateKeranjang').removeAttr('disabled');
        var prev = $('#' + $(el).data('id')).val();
        if (parseInt(prev) > 1) {
            $('#' + $(el).data('id')).val(parseInt(prev) - +1);
            $('#updateKeranjang').removeClass('disabled');
        }
        var krjid = parseInt($(el).data('id'));
        var krjjumlah = parseInt($('#' + $(el).data('id')).val());
        if (idSend.includes(krjid)) {
            qtySend[idSend.findIndex(el => el == krjid)] = krjjumlah;
        } else {
            idSend.push(krjid);
            qtySend.push(krjjumlah);

        }
    }

    function updateCart() {
        $.ajax({
            method: "POST",
            url: "<?= base_url('keranjang/update_qty'); ?>",
            data: {
                id: idSend,
                jumlah: qtySend
            }
        }).done(function(r) {
            window.location.href = '<?= base_url('keranjang'); ?>';
        });
    }
</script>