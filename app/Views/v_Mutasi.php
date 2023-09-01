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
                        <th>Nama Nasabah</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($mutasi as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_nasabah'] ?></td>
                            <td><?= $value['jenis'] ?></td>
                            <td><?= $value['jumlah'] ?></td>
                            <td>
                                <a href="<?= base_url('Mutasi/DetailMutasi') ?>/<?= $value['id_nasabah'] ?>" class="btn btn-flat btn-primary btn-xs"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-flat btn-danger btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_mutasi'] ?>"><i class="fas fa-trash"></i></button>
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
                <h4 class="modal-title">Tambah Mutasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Mutasi/insertData');
            ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nasabah</label>
                    <select name="nasabah_id" class="form-control">
                        <option value="0">--Pilih Nasabah--</option>
                        <?php foreach ($nasabah as $key => $value) { ?>
                            <option value="<?= $value['id_nasabah'] ?>"><?= $value['nama_nasabah'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="jenis" class="form-control">
                            <option value="">--Pilih Jenis Transaksi--</option>
                            <option value="1">Debit</option>
                            <option value="2">Kredit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nominal</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" class="form-control" name="nominal_masuk" placeholder="Nominal">
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


<!-- Modal Delete -->
<?php foreach ($mutasi as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_mutasi'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Mutasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda Ingin Menghapus Data <b><?= $value['username_nasabah'] ?></b> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Mutasi/deleteData/' . $value['id_mutasi']) ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>


<?= $this->endSection() ?>