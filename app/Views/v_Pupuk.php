<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="col-sm-12 text-right">
        <h6><b>Stock Saat ini : <?= number_format($saldoTerakhir) ?></b></h6>
    </div>
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $subtitle ?></h3>
            <div class="card-tools">
                <button class="btn btn-flat btn-dark btn-xs" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>Nama Penyetor</th>
                        <th>Nama Pupuk</th>
                        <th>Tgl Setor</th>
                        <th>Jumlah Setor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pupuk as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_penyetor'] ?></td>
                            <td><?= $value['jenis_pupuk'] ?></td>
                            <td><?= $value['tgl_masuk'] ?></td>
                            <td><?= $value['jumlah_masuk'] ?></td>
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
                <h4 class="modal-title">Tambah Stock Pupuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open_multipart('Pupuk/insertData');
            helper('text');
            $tgl_setor = date('Y-m-d H:i:s');
            ?>
            <div class="modal-body">
                <div class="form-group" style="display: none;">
                    <label>Stock</label>
                    <input type="text" name="stock">
                </div>
                <div class="form-group">
                    <label>Tanggal Setor</label>
                    <input type="text" name="tgl_masuk" value="<?= $tgl_setor ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Penyetor</label>
                    <input name="nama_penyetor" class="form-control" placeholder="Nama Penyetor" required>
                </div>
                <div class="form-group">
                    <label>Jenis Pupuk</label>
                    <select name="id_jenis_pupuk" class="form-control">
                        <option value="0">--Pilih Jenis Pupuk--</option>
                        <?php foreach ($jenispupuk as $key => $value) { ?>
                            <option value="<?= $value['id_jenis_pupuk'] ?>"><?= $value['jenis_pupuk'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Setor</label>
                    <div class="col-sm-4">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="jumlah_masuk">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Sak</div>
                            </div>
                        </div>
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




<?= $this->endSection() ?>