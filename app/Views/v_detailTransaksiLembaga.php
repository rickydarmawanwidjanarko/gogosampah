<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('TransaksiSampah') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
<br>
<br>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="100px">Lembaga</th>
                <th width="30px">:</th>
                <td>Nama Lembaga</td>
                <th width="180px">NIK</th>
                <th width="30px">:</th>
                <td></td>
            </tr>
            <tr>
                <th width="120px">Telp</th>
                <th>:</th>
                <td>No telp</td>
                <th>Alamat</th>
                <th>:</th>
                <td>Alamat</td>
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
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Order</th>
                        <th>Tanggal Order</th>
                        <th>Jenis Transaksi</th>
                        <th>Berat</th>
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
                        <td>Berat</td>
                        <td>Total harga</td>
                        <td>
                            <a href=" <?= base_url('TransaksiLembaga/detailOrderLembaga') ?>"><i class="btn btn-sm btn-info fas fa-eye"></i></a>
                            <a href=" <?= base_url('PdfController/view_pdf') ?>"><i class="btn btn-sm btn-warning fas fa-paper-plane"></i></a>
                        </td>
                    </tr>
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

            <div class="modal-body">
                <input type="hidden" value="" name="">
                <div class="form-group">
                    <label>Tanggal Transaksi Lembaga</label>
                    <input type="text" name="created_at" value="" class="form-control" readonly>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis Transaksi</label>
                                <select name="jenis" class="form-control sel-jenis">
                                    <option value="1">Debit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis Sampah</label>
                                <select name="id_jenis_sampah" class="form-control">
                                    <option value="0">--Pilih Jenis Sampah--</option>

                                    <option value=""></option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group canvas-berat" style="display: none;">
                    <label>Berat</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="" placeholder="Berat">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Kg </div>
                        </div>
                    </div>
                </div>

                <div class="form-group canvas-jumlah" style="display: none;">
                    <label>Jumlah</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="" placeholder="Jumlah">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Delete -->

<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Transaksi Lembaga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Ingin Menghapus Data <b></b> ?
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <a href="<?= base_url('TransaksiLembaga/deleteData/') ?>" class="btn btn-danger btn-sm">Delete</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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