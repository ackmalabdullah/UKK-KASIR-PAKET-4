<?php
$text = "CARLIMART";
if (isset($penjualan['id_penjualan'])) {
    $angka = explode('-', $penjualan['id_penjualan']);
    $angka = $angka[1];
} else {
    $angka = "000";
}

$angka = sprintf('%03d', $angka + 1);
$id_penjualan = "$text-$angka";
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Penjualan</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tambah Penjualan</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('petugas') ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Penjualan</label>
                        <input readonly type="text" name="id_penjualan" value="<?= $id_penjualan ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('id_penjualan') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Pelanggan / Nama Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" id="">
                            <option value="">Pilih Pelanggan</option>
                            <?php foreach ($pelanggan as $p) : ?>
                                <option value="<?= $p['id_pelanggan'] ?>"><?= $p['id_pelanggan'] ?> <?= $p['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <small class="text-danger"><?= form_error('id_pelanggan') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Jumlah Produk</label>
                        <input type="number" name="jumlah_produk" value="<?= set_value('jumlah_produk') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('jumlah_produk') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>