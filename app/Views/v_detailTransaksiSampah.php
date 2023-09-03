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
                <td><?php if ($transaksisampah[0]['jenis'] == '1') { ?>
                        <?= $tot_saldo['nominal_masuk'] + $tot_debit['jumlah'] ?>
                    <?php  } else { ?>
                        <?= $tot_saldo['nominal_masuk'] - $tot_kredit['jumlah'] ?>
                    <?php  } ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Detail <?= $subtitle ?></h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Transaksi Sampah</th>
                        <th>Jenis Transaksi</th>
                        <th>Jenis Sampah</th>
                        <th>Nominal</th>
                        <th>Action</th>
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
                            <td><?= $value['jumlah'] ?></td>
                            <td>
                                <button class="btn btn-flat btn-warning btn-xs" data-toggle="modal" data-target="#edit<?= $value['id_transaksi_sampah'] ?>"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
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
                        <select name="jenis" class="form-control" required>
                            <option value="1" <?= $value['jenis'] == 'Debit' ? 'selected' : '' ?>>Debit</option>
                            <option value="2" <?= $value['jenis'] == 'Kredit' ? 'selected' : '' ?>>Kredit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Sampah</label>
                        <select name="id_jenis_sampah" class="form-control">
                            <option value="0">--Pilih Jenis Sampah--</option>
                            <?php foreach ($jenissampah as $key => $s) { ?>
                                <option value="<?= $s['id_jenis_sampah'] ?>" <?= $jenissampah['id_jenis_sampah'] == $s['id_jenis_sampah'] ? 'selected' : '' ?>>
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

<?= $this->endSection() ?>