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
                <td>total saldo</td>
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
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tabungan as $key => $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['tgl_masuk'] ?></td>
                            <td><?= $value['nominal_masuk'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<?= $this->endSection() ?>