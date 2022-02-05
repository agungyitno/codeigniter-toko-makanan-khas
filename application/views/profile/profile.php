<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->

    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow mb-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img-top bg-light" alt="...">
                        <div class="card-body">
                            <h3 class="card-title text-center text-capitalize"><?= $user["name"]; ?></h3>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h5>Email :</h5>
                                </div>
                                <div class="col-sm text-right">
                                    <h5><a href="mailto:<?= $user["email"]; ?>"><?= $user["email"]; ?></a></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h5>Level :</h5>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $r_now["role"]; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="text-center mt-4">
                                <button class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#editModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit Profile</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card shadow mb-4">
                        <div class="card-header text-primary">
                            <h5 class="p-0 m-0 font-weigth-bold">Pesanan</h5>
                        </div>
                        <?php
                        if (isset($_GET['pesanan'])) {
                            $filter = $_GET['pesanan'];
                        }
                        ?>
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'semua' || empty($filter) ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=semua'); ?>">Semua Pesanan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'belum bayar' ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=belum+bayar'); ?>">Belum Dibayar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'dibayar' ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=dibayar'); ?>">Dibayar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'diproses' ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=diproses'); ?>">Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'dikirim' ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=dikirim'); ?>">Dikirim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= !empty($filter) && $filter == 'selesai' ? 'active' : '' ?>" href="<?= base_url('profile/?pesanan=selesai'); ?>">Selesai</a>
                                </li>
                            </ul>
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Pesanan</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;  ?>
                                    <?php foreach ($pesanan as $k) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $k["id_pesanan"]; ?></td>
                                            <td>Rp. <?= number_format($k['total'], 0, ',', '.'); ?></td>
                                            <td><?= date('d/m/Y', $k["tgl_pesanan"]); ?></td>
                                            <td>
                                                <?php if ($k["status"] == 'Belum Bayar') : ?>
                                                    <div class="badge badge-danger"><?= $k["status"]; ?></div>
                                                <?php elseif ($k["status"] == 'Dibayar') : ?>
                                                    <div class="badge badge-warning"><?= $k["status"]; ?></div>
                                                <?php elseif ($k["status"] == 'Diproses') : ?>
                                                    <div class="badge badge-info"><?= $k["status"]; ?></div>
                                                <?php elseif ($k["status"] == 'Dikirim') : ?>
                                                    <div class="badge badge-secondary"><?= $k["status"]; ?></div>
                                                <?php elseif ($k["status"] == 'Selesai') : ?>
                                                    <div class="badge badge-success"><?= $k["status"]; ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a title="Lihat Pesanan" href="<?= base_url('profile/pesanan/') . $k['id_pesanan']; ?>" class="btn btn-primary btn-sm">
                                                    lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <hr class="sidebar-divider">
                            <div class="text-center mt-4">

                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header text-primary">
                            <h5 class="p-0 m-0 font-weigth-bold">Informasi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Nama :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->nama; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Nomor Telepon :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->no_telp; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Alamat :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->alamat; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Kode Pos :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->kode_pos; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Kota :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->kota; ?></h5>
                                </div>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm">
                                    <h6>Provinsi :</h6>
                                </div>
                                <div class="col-sm text-right">
                                    <h5 class="text-capitalize"><?= $pelanggan->provinsi; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEdit" action="<?= base_url('profile/edit'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idEdit" value="<?= $user['name']; ?>">
                    <div class="row">
                        <div class="col">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" id="imgPreview" alt="imgPreview" class="img-thumbnail mb-4">
                            <div class="form-group">
                                <label for="Foto">Foto Profil</label>
                                <input type="file" accept="image/*" class="form-control" id="Foto" name="Foto">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password Baru</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Kosongkan jika tidak ingin mengganti password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Nama">Nama</label>
                                <input value="<?= $user["name"]; ?>" oninvalid="invalidInput(this)" type="text" class="form-control" id="Nama" name="Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="Telepon">No Telepon</label>
                                <input value="<?= $pelanggan->no_telp; ?>" type="text" class="form-control" id="Telepon" name="Telepon">
                            </div>
                            <div class="form-group">
                                <label for="Alamat">Alamat</label>
                                <input value="<?= $pelanggan->alamat; ?>" type="text" class="form-control" id="Alamat" name="Alamat">
                            </div>
                            <div class="form-group">
                                <label for="KodePos">Kode Pos</label>
                                <input value="<?= $pelanggan->kode_pos; ?>" type="text" class="form-control" id="KodePos" name="KodePos">
                            </div>
                            <div class="form-group">
                                <label for="Kota">Kota/Kabupaten</label>
                                <input value="<?= $pelanggan->kota; ?>" type="text" class="form-control" id="Kota" name="Kota">
                            </div>
                            <div class="form-group">
                                <label for="Provinsi">Provinsi</label>
                                <input value="<?= $pelanggan->provinsi; ?>" type="text" class="form-control" id="Provinsi" name="Provinsi">
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