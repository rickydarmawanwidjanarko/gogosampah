<?php if (session()->get('level') == 'Nasabah') { ?>
    <?= $this->extend('template/template-nasabah') ?>
    <?= $this->section('content') ?>
    <div class="container">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3 text-left">
                    <a href="<?= base_url('Main') ?>" type="Button" class="btn btn-sm btn-success"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-3">
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-portrait"></i> Foto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#foto"><i class="fas fa-pencil-alt text-white"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="text-center">
                            <?php if ($nasabah['foto'] == null) { ?>
                                <img src="<?= base_url('foto/blank.jpg') ?>" width="200px" height="220px">
                            <?php } else { ?>
                                <img src="<?= base_url('foto/' . $nasabah['foto']) ?>" width="200px" height="220px">
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- Data Profile -->
            <div class="col-sm-9">
                <div class="card card-navy">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-id-badge"></i> Data Pribadi</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm text-white" data-toggle="modal" data-target="#editdatapribadi">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        if (session()->getFlashdata('editdatapribadi')) {
                            echo '<div class="alert alert-warning alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fas fa-check"></i>';
                            echo session()->getFlashdata('editdatapribadi');
                            echo '</h5></div>';
                        }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-university"></i> NIK</strong>
                                <p class="text-muted"><?= $nasabah['nik'] ?></p>
                                <hr>
                                <strong><i class="fas fa-book mr-1"></i> Nama Lengkap</strong>
                                <p class="text-muted"><?= $nasabah['nama_nasabah'] ?></p>
                                <hr>
                                <strong><i class="fas fa-clinic-medical"></i> Alamat</strong>
                                <?= ($nasabah['alamat'] == null) ? '<p>-</p>' : '<p class="text-muted">' . $nasabah['alamat'] . '</p>'  ?>

                            </div>

                            <div class="col-sm-6">
                                <strong><i class="fas fa-venus-mars"></i> Jenis Kelamin</strong>
                                <?= ($nasabah['jk'] == null) ? '<p>-</p>' : '<p class="text-muted">' . $nasabah['jk'] . '</p>'  ?>
                                <hr>
                                <strong><i class="fas fa-mobile-alt"></i> Telp/Hp</strong>
                                <?= ($nasabah['telp'] == null) ? '<p>-</p>' : '<p class="text-muted">' . $nasabah['telp'] . '</p>'  ?>
                                <hr>
                                <strong><i class="fas fa-place-of-worship"></i> Agama</strong>
                                <?= ($nasabah['agama'] == null) ? '<p>-</p>' : '<p class="text-muted">' . $nasabah['agama'] . '</p>'  ?>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- End Data Profile -->
        </div>

        <!-- Modal Foto -->
        <div class="modal fade" id="foto">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Foto</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open_multipart('Profile/updateFoto/' . $nasabah['id_nasabah']) ?>
                    <div class="modal-body">
                        <p class="text-danger">Max Foto 1024kb</p>
                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input type="file" id="preview_gambar" class="form-control" name="foto" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Preview</label> <br>
                            <?php if ($nasabah['foto'] == null) { ?>
                                <img src="<?= base_url('foto/blank.jpg') ?>" width="140px" height="160px" id="gambar_load">
                            <?php } else { ?>
                                <img src="<?= base_url('foto/' . $nasabah['foto']) ?>" width="140px" height="160px" id="gambar_load">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Modal Edit Data Profile -->
        <div class="modal fade" id="editdatapribadi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Pribadi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php echo form_open('Nasabah/editDataPribadi/' . $nasabah['id_nasabah']) ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap<span class="error text-danger"> *</span></label>
                                            <input name="nama_nasabah" value="<?= $nasabah['nama_nasabah']; ?>" class="form-control" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>NIK<span class="error text-danger"> *</span></label>
                                            <input name="nik" value="<?= $nasabah['nik']; ?>" class="form-control" placeholder="NIK" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin<span class="error text-danger"> *</span></label>
                                            <select name="jk" class="form-control" required>
                                                <option value="L" <?= $nasabah['jk'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                                                <option value="P" <?= $nasabah['jk'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Agama<span class="error text-danger"> *</span></label>
                                            <select name="id_agama" class="form-control" required>
                                                <option value="">--Pilih Agama--</option>
                                                <?php foreach ($agama as $key => $value) { ?>
                                                    <option value="<?= $value['id_agama'] ?>" <?= $nasabah['id_agama'] == $value['id_agama'] ? 'selected' : '' ?>>
                                                        <?= $value['agama'] ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat<span class="error text-danger"> *</span></label>
                                            <input name="alamat" value="<?= $nasabah['alamat'] ?>" class="form-control" placeholder="Alamat" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>No. HP<span class="error text-danger"> *</span></label>
                                            <input name="telp" onkeypress="return event.keyCode >= 48 && event.keyCode <= 57" value="<?= $nasabah['telp'] ?>" class="form-control" placeholder="No. HP" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Edit Data Profile -->
        <?= $this->endSection() ?>
    <?php } ?>