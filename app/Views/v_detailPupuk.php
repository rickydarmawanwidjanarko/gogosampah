<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('Pupuk') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
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
                        <th>Tanggal Pupuk Masuk</th>
                        <th>Total Karung</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pupuk as $key => $value) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['tgl_masuk'] ?></td>
                            <td><?= $value['jenis_sampah'] ?></td>
                            <td><?= $value['jumlah_masuk'] ?></td>
                            <td>
                                <a href=" <?= base_url('PdfController/view_pdf') ?>/<?= $value['id_pupuk'] ?>"><i class="fas fa-paper-plane"></i></a>
                            </td>
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
                <h4 class="modal-title">Tambah Pupuk Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Pupuk/insertData');
            helper('text');
            $dibuat_tgl = date('Y-m-d H:i:s');
            ?>
            <div class="modal-body">
                <input type="hidden" value="<?= $nasabah['id_nasabah']; ?>" name="id_nasabah">
                <div class="form-group">
                    <label>Tanggal Transaksi Sampah</label>
                    <input type="text" name="created_at" value="<?= $dibuat_tgl ?>" class="form-control" readonly>
                </div>
                <div class="col-sm-12">
                    <div class="row">
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
                    <label>Nominal</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp. </div>
                        </div>
                        <input type="text" class="form-control" name="jumlah" placeholder="Nominal">
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
<?php foreach ($pupuk as $key => $value) { ?>
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