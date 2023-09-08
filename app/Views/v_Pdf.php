<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <?= $title ?>
                            <small class="float-right"><strong>Tanggal cetak :</strong> <?= date('d-m-Y') ?></small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        Dari :
                        <address>
                            <strong><?= session()->get('username') ?></strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Kepada :
                        <address>
                            <strong><?= $nasabah['nama_nasabah'] ?></strong><br>
                            <?= $nasabah['alamat'] ?><br>
                            Phone: <?= $nasabah['telp'] ?><br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <b>Jenis Transaksi:</b> <?php switch ($transaksisampah[0]['jenis']) {
                                                    case '1':
                                                        echo 'Debit';
                                                        break;
                                                    case '2':
                                                        echo 'Kredit';
                                                        break;
                                                    default:
                                                        echo '';
                                                        break;
                                                } ?><br>
                        <b>Tanggal Transaksi:</b> <?= $transaksisampah[0]['created_at'] ?><br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Sampah</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Total Saldo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($transaksisampah as $key => $value) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['jenis_sampah'] ?></td>
                                        <td><?= $value['jumlah'] ?> Kg</td>
                                        <td>Rp. Harga</td>
                                        <td>Rp. <?= $nasabah['saldo'] ?></td>
                                    </tr>
                            </tbody>
                        <?php endforeach; ?>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <a href="<?= base_url('PdfController/generate') ?>/<?= $value['id_nasabah'] ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
            <!-- /.invoice -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
<!-- /.content -->
</div>

<?= $this->endSection() ?>