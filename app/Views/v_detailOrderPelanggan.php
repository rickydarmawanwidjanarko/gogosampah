<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('TransaksiPelanggan') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
<br>
<br>
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
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Order</th>
                        <th>Tanggal Order</th>
                        <th>Jenis Transaksi</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No</td>
                        <td>No. Order</td>
                        <td>Tgl order</td>
                        <td>Debit</td>
                        <td>Quantity</td>
                        <td>Total harga</td>
                        <td>
                            <a href=" <?= base_url('TransaksiPelanggan/detailOrderPelanggan') ?>"><i class="btn btn-sm btn-info fas fa-eye"></i></a>
                            <a href=" <?= base_url('PdfController/view_pdf') ?>"><i class="btn btn-sm btn-warning fas fa-paper-plane"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


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