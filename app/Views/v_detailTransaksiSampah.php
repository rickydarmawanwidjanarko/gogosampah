<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('TransaksiSampah') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
<br>
<br>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="100px">Nasabah</th>
                <th width="30px">:</th>
                <td><?= $nasabah['nama_nasabah'] ?></td>
                <th width="180px">NIK</th>
                <th width="30px">:</th>
                <td><?= $nasabah['nik'] ?></td>
            </tr>
            <tr>
                <th width="120px">Telp</th>
                <th>:</th>
                <td><?= $nasabah['telp'] ?></td>
                <th>Alamat</th>
                <th>:</th>
                <td><?= $nasabah['alamat'] ?></td>
            </tr>
            <tr>
                <th>Total Saldo</th>
                <th>:</th>
                <td>
                    <?= $nasabah['saldo']; ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Detail <?= $subtitle ?></h3>
            <div class="card-tools">
                <button class="btn btn-flat btn-dark btn-xs" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <tr>
                    <th>#</th>
                    <th>Tanggal Transaksi Sampah</th>
                    <th>Jenis Transaksi</th>
                    <th>Jenis Sampah</th>
                    <th>Jumlah</th>
                    <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($transaksisampah as $key => $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['created_at'] ?></td>
                            <td><?php switch ($value['jenis']) {
                                    case '1':
                                        echo 'Debit';
                                        break;
                                    case '2':
                                        echo 'Kredit';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                } ?></td>
                            <td><?= $value['jenis_sampah'] ?></td>
                            <td>
                                <?php 
                                    if ($value['jenis'] == 2) {
                                        echo $value['jumlah'].' Kg';
                                    } else {
                                        echo $value['jumlah'];
                                    }
                                ?>
                            </td>
                            <!-- <td>
                                <button class="btn btn-flat btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $value['id_transaksi_sampah'] ?>"><i class="fas fa-edit"></i></button>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
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
                <h4 class="modal-title">Tambah Transaksi Sampah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('TransaksiSampah/insertData');
            helper('text');
            $dibuat_tgl = date('Y-m-d H:i:s');
            ?>
            <div class="modal-body">
                <input type="hidden" value="<?= $nasabah['id_nasabah']; ?>" name="id_nasabah">
                <div class="form-group">
                    <label>Tanggal Transaksi Sampah</label>
                    <input type="text" name="created_at" value="<?= $dibuat_tgl ?>" class="form-control" readonly>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Transaksi</label>
                        <select name="jenis" class="form-control sel-jenis">
                            <option value="">--Pilih Jenis Transaksi--</option>
                            <option value="1">Debit</option>
                            <option value="2">Kredit</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Jenis Sampah</label>
                        <select name="id_jenis_sampah" class="form-control">
                            <option value="0">--Pilih Jenis Sampah--</option>
                            <?php foreach ($jenissampah as $key => $value) { ?>
                                <option value="<?= $value['id_jenis_sampah'] ?>"><?= $value['jenis_sampah'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group canvas-berat" style="display: none;">
                    <label>Berat</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="berat" placeholder="Berat">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Kg </div>
                        </div>
                    </div>
                </div>

                <div class="form-group canvas-jumlah" style="display: none;">
                    <label>Jumlah</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="jumlah" placeholder="Jumlah">
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

<!-- Modal Edit -->
<?php foreach ($transaksisampah as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_transaksi_sampah'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Transaksi Sampah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('TransaksiSampah/editData/' . $value['id_transaksi_sampah']);
                helper('text');
                $dibuat_tgl = $value['created_at'];
                $diubah_tgl = date('Y-m-d H:i:s');
                ?>
                <div class="modal-body">
                    <input type="hidden" value="<?= $nasabah['id_nasabah']; ?>" name="id_nasabah">
                    <input type="hidden" value="<?= $dibuat_tgl; ?>" name="created_at">
                    <div class="form-group">
                        <label>Diubah Tanggal</label>
                        <input type="text" name="updated_at" value="<?= $diubah_tgl ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Transaksi Sampah</label>
                        <select name="jenis" class="form-control sel-jenis" required>
                            <option value="1" <?= $value['jenis'] == 'Debit' ? 'selected' : '' ?>>Debit</option>
                            <option value="2" <?= $value['jenis'] == 'Kredit' ? 'selected' : '' ?>>Kredit</option>
                        </select>
                    </div>
                    <div class="form-group">

                        <label>Jenis Sampah</label>
                        <select name="id_jenis_sampah" class="form-control">
                            <option value="0">--Pilih Jenis Sampah--</option>
                            <?php
                            foreach ($jenissampah as $key => $s) { ?>
                                <option value="<?= $s['id_jenis_sampah'] ?>" <?= $s['id_jenis_sampah'] == $value['id_jenis_sampah'] ? 'selected' : '' ?>>
                                    <?= $s['jenis_sampah'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input name="jumlah" value="<?= $value['jumlah'] ?>" class="form-control" placeholder="Nominal" required>
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
<?php } ?>

<!-- Modal Delete -->
<?php foreach ($transaksisampah as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_transaksi_sampah'] ?>">
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
                    <a href="<?= base_url('TransaksiSampah/deleteData/' . $value['id_transaksi_sampah']) ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    // alert(1)
    $('.sel-jenis').change(function(e) {
        let v = $(this).val()
        if (v == 1) {
            $('.canvas-berat').hide()
            $('.canvas-jumlah').show()
        } else {
            $('.canvas-jumlah').hide()
            $('.canvas-berat').show()
        }
    })
</script>
<?= $this->endSection() ?>