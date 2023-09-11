<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<a href="<?= base_url('TransaksiLembaga') ?>" class="btn btn-success"><i class="fas fa-arrow-left"></i> Back</a>
<br>
<br>
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="100px">Lembaga</th>
                <th width="30px">:</th>
                <td><?= $lembaga['nama_lembaga']; ?></td>
                <!-- <th width="180px">NIK</th>
                <th width="30px">:</th>
                <td></td> -->
                <th>Alamat</th>
                <th>:</th>
                <td><?= $lembaga['alamat']; ?></td>
            </tr>
            <tr>
                <th width="120px">Telp</th>
                <th>:</th>
                <td><?= $lembaga['telp']; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Daftar <?= $subtitle ?></h3>
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
                        <th>Berat</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $n = 1;
                    foreach ($order_lembaga as $key => $value) :
                    ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $value['kode_order']; ?></td>
                            <td><?= $value['created_at']; ?></td>
                            <td>Berat</td>
                            <td><?= $value['total']; ?></td>
                            <td>
                                <a href=" <?= base_url('TransaksiLembaga/detailOrderLembaga') ?>"><i class="btn btn-sm btn-info fas fa-eye"></i></a>
                                <a href=" <?= base_url('PdfController/view_pdf') ?>"><i class="btn btn-sm btn-warning fas fa-paper-plane"></i></a>
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
                <h4 class="modal-title">Order Sampah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" value="" name="">
                <div class="col-sm-12">
                    <div class="row canvas-order-template">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Jenis Sampah</label>
                                <select name="id_jenis_sampah" class="form-control sel-jenis">
                                    <option value="0">--Pilih Jenis Sampah--</option>
                                    <?php
                                    foreach ($jenis_sampah as $key => $vj) :
                                    ?>
                                        <option value="<?= $vj['id_jenis_sampah']; ?>"><?= $vj['jenis_sampah']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Berat</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control txt-berat" name="berat" placeholder="Berat">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Kg </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Stok Berat</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control txt-stok-berat" name="" placeholder="Berat" readonly>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Kg </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row canvas-order">
                    </div>
                    <button class="btn btn-sm btn-info btn-add"><i class="fas fa-plus"></i></button>
                </div>

                <!-- <div class="form-group canvas-berat">
                    <label>Berat</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="" placeholder="Berat">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Kg </div>
                        </div>
                    </div>
                </div> -->

                <div class="form-group canvas-jumlah" style="display: none;">
                    <label>Jumlah Bayar</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" name="" placeholder="Jumlah Bayar">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-sm btn-simpan">Simpan</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).on('change', '.sel-jenis', function(e) {
        let v = $(this).val();
        let currentRow = $(this).closest('.canvas-order, .canvas-order-template');
        console.log(currentRow)
        $.ajax({
            type: "POST",
            url: "<?= base_url('TransaksiLembaga/ajaxStokJenis'); ?>",
            data: {
                id_jenis_sampah: v
            },
            dataType: "json",
            success: function(data) {
                // Set value untuk .txt-stok-berat di dalam row yang sama
                currentRow.find('.txt-stok-berat').val(data.data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $('.btn-add').click(function(e) {
        e.preventDefault()
        const canvasOrderTemplate = $('.canvas-order-template:last').clone();
        canvasOrderTemplate.find('input').val('');

        canvasOrderTemplate.removeClass('canvas-order-template').addClass('canvas-order');

        const deleteButton = '<div class="col-sm-12 text-right"><button class="btn btn-sm btn-danger btn-delete">Hapus</button></div>';
        canvasOrderTemplate.append(deleteButton);

        $('.canvas-order').append(canvasOrderTemplate);

    })

    $(document).on('click', '.btn-delete', function() {
        $(this).closest('.canvas-order').remove();
    });

    $('.btn-simpan').click(function(e) {
        e.preventDefault()

        let arr_jenis_sampah = []
        let arr_berat = []

        $('.sel-jenis').each(function(i, v) {
            let vjenis = $(this).val()
            let vberat = $('.txt-berat').eq(i).val()
            // console.log(vjenis)
            arr_jenis_sampah.push(vjenis)
            arr_berat.push(vberat)
        })

        $.ajax({
            type: "POST",
            url: "<?= base_url('TransaksiLembaga/ajaxOrder'); ?>",
            data: {
                id_lembaga: '<?= $lembaga['id_lembaga']; ?>',
                arr_jenis_sampah: arr_jenis_sampah,
                arr_berat: arr_berat
            },
            dataType: "json",
            success: function(data) {

                if (data.success) {
                    alert(data.data);
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    })
</script>
<?= $this->endSection() ?>