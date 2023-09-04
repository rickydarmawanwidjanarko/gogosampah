<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | <?= $subtitle ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <?= $title ?>
                        <small class="float-right"><strong>Tanggal cetak :</strong> <?= date('d-m-Y') ?></small>
                    </h2>
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
                        Email: info@almasaeedstudio.com
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
                    <b>Tanggal Transaksi:</b><?= $transaksisampah[0]['created_at'] ?><br>
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
                                    <td><?= $transaksisampah[0]['jenis_sampah'] ?></td>
                                    <td><?= $transaksisampah[0]['jumlah'] ?> Kg</td>
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

            <div class="row">

                <!-- /.col -->
                <div class="col-6">
                    <div class="table-responsive">
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>