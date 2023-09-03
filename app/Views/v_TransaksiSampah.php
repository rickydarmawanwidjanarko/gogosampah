<?= $this->extend('template/template-admin') ?>
<?= $this->section('content') ?>
<div class="col-sm-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data <?= $subtitle ?></h3>
        </div>
        <div class="card-body p-0">
            <?php
            if (session()->getFlashdata('tambah')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('tambah');
                echo '</h5></div>';
            }

            if (session()->getFlashdata('delete')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('delete');
                echo '</h5></div>';
            }

            ?>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="70px">#</th>
                            <th>Nama Nasabah</th>
                            <th>Saldo</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($nasabah as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_nasabah'] ?></td>
                                <td><?= empty($value['saldo']) ? 0 : $value['saldo']; ?></td>
                                <td>
                                    <a href="<?= base_url('TransaksiSampah/detailTransaksiSampah') ?>/<?= $value['id_nasabah'] ?>" class="btn btn-flat btn-primary btn-xs"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection() ?>