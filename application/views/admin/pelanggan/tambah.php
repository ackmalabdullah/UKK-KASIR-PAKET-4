<?php
$id_pelanggan = $pelanggan['id_pelanggan'];
$id_pelanggan_array = explode('-', $id_pelanggan);
$text = $id_pelanggan_array[0];
$angka = sprintf('%03d', $id_pelanggan_array[1] + 1);
$id_pelanggan_baru = "$text-$angka";

?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pelanggan</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tambah Pelanggan</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/tambahpelanggan') ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Pelanggan</label>
                        <input readonly type="text" name="id_pelanggan" value="<?= $id_pelanggan_baru ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('id_pelanggan') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pelanggan</label>
                        <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('nama') ?></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"><?= set_value('alamat') ?></textarea>
                        <small class="text-danger"><?= form_error('alamat') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">No Telepon</label>
                        <input type="number" name="no_telepon" value="<?= set_value('no_telepon') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('no_telepon') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>