<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $subtitle ?></h3>
            <div class="card-tools">
                <button class="btn btn-flat btn-dark btn-xs" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="card-body p-0">
            <?php
            if (session()->getFlashdata('tambah')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('tambah');
                echo '</h5></div>';
            }

            if (session()->getFlashdata('edit')) {
                echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('edit');
                echo '</h5></div>';
            }

            if (session()->getFlashdata('delete')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('delete');
                echo '</h5></div>';
            }

            ?>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>NIK</th>
                        <th>Nama Nasabah</th>
                        <th>Telp</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th class="text-center">Foto</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($nasabah as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nik'] ?></td>
                            <td><?= $value['nama_nasabah'] ?></td>
                            <td><?= $value['telp'] ?></td>
                            <td><?= $value['jk'] ?></td>
                            <td><?= $value['agama'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td><?= $value['username_nasabah'] ?></td>
                            <td><?= $value['password_nasabah'] ?></td>
                            <td><?= $value['level'] ?></td>
                            <?php if ($value['foto'] == null) { ?>
                                <td class="text-center"><img class="img-circle img-fluid" src="<?= base_url('foto/blank.jpg') ?>" width='50px' height="50px"></td>
                            <?php } else { ?>
                                <td class="text-center"><img class="img-circle img-fluid" src="<?= base_url('foto/' . $value['foto']) ?>" width='50px' height="50px"></td>
                            <?php } ?>
                            <td><button class="btn btn-flat btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $value['id_nasabah'] ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-flat btn-danger btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_nasabah'] ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Nasabah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Nasabah/insertData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>NIK</label>
                    <input name="nik" class="form-control" placeholder="NIK" required>
                </div>
                <div class="form-group">
                    <label>Nama Nasabah</label>
                    <input name="nama_nasabah" class="form-control" placeholder="Nama Nasabah" required>
                </div>
                <div class="form-group">
                    <label>Telp</label>
                    <input name="telp" class="form-control" placeholder="Telp" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jk" class="form-control">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Agama</label>
                    <select name="id_agama" class="form-control">
                        <option value="0">--Pilih Agama--</option>
                        <?php foreach ($agama as $key => $v) { ?>
                            <option value="<?= $v['id_agama'] ?>"><?= $v['agama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat" class="form-control" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input name="username_nasabah" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password_nasabah" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="id_level" class="form-control">
                        <option value="0">--Pilih Level--</option>
                        <?php foreach ($level as $key => $value) { ?>
                            <option value="<?= $value['id_level'] ?>"><?= $value['level'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Edit -->
<?php foreach ($nasabah as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_nasabah'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Nasabah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open_multipart('Nasabah/editData/' . $value['id_nasabah']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIK</label>
                        <input name="nik" value="<?= $value['nik'] ?>" class="form-control" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Nasabah</label>
                        <input name="nama_nasabah" value="<?= $value['nama_nasabah'] ?>" class="form-control" placeholder="Nama Nasabah" required>
                    </div>
                    <div class="form-group">
                        <label>Telp</label>
                        <input name="telp" value="<?= $value['telp'] ?>" class="form-control" placeholder="Telp" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control" required>
                            <option value="" <?= $value['jk'] == '' ? 'selected' : '' ?>>Pilih Jenis Kelamin</option>
                            <option value="L" <?= $value['jk'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                            <option value="P" <?= $value['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="id_agama" class="form-control">
                            <option value="<?= $value['id_agama'] ?>"><?= $value['agama'] ?></option>
                            <?php foreach ($agama as $key => $v) { ?>
                                <option value="<?= $v['id_agama'] ?>"><?= $v['agama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" value="<?= $value['alamat'] ?>" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username_nasabah" value="<?= $value['username_nasabah'] ?>" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password_nasabah" value="<?= $value['password_nasabah'] ?>" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="id_level" class="form-control">
                            <option value="<?= $value['id_level'] ?>"><?= $value['level'] ?></option>
                            <?php foreach ($level as $key => $l) { ?>
                                <option value="<?= $l['id_level'] ?>"><?= $l['level'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <img src="<?= base_url('foto/' . $value['foto']) ?>" width="100px">
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Ganti Foto</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- Modal Delete -->
<?php foreach ($nasabah as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_nasabah'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Nasabah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Ingin Menghapus Data <b><?= $value['username_nasabah'] ?></b> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Nasabah/deleteData/' . $value['id_nasabah']) ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>


<?= $this->endSection() ?>