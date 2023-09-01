<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('Tabungan') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
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
                <td><?= $tot_saldo['nominal_masuk'] ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $subtitle ?></h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nominal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tabungan as $key => $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['tgl_masuk'] ?></td>
                            <td><?= $value['nominal_masuk'] ?></td>
                            <td>
                                <button class="btn btn-flat btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $value['id_tabungan'] ?>"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php foreach ($tabungan as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_tabungan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tabungan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('Tabungan/editData/' . $value['id_tabungan']) ?>
                <div class="modal-body">
                    <input type="hidden" value="<?= $nasabah['id_nasabah']; ?>" name="id_nasabah">
                    <div class="form-group">
                        <label>Tanggal Transaksi</label>
                        <input name="tgl_masuk" value="<?= $value['tgl_masuk'] ?>" class="form-control" placeholder="Tanggal" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input name="nominal_masuk" value="<?= $value['nominal_masuk'] ?>" class="form-control" placeholder="Nominal" required>
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

<?= $this->endSection() ?>