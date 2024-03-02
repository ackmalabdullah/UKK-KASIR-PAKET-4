<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Penjualan</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Pilih Produk</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('petugas/pilihproduk/' . $penjualan['id_penjualan']) ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Penjualan</label>
                        <input readonly type="text" name="id_penjualan" value="<?= $penjualan['id_penjualan'] ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('id_penjualan') ?></small>
                    </div>
                    <?php for ($a = 1; $a <= $penjualan['jumlah_produk']; $a++) : ?>
                        <div class="form-group">

                            <div class="row">
                                <div class="col-lg">
                                    <label for="exampleFormControlInput1">Barang Ke <?= $a ?></label>
                                    <select required name="id_produk[]" class="form-control" id="">
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($produk as $p) : ?>
                                            <?php if ($p['stok'] <= 10 and $p['stok'] >= 1) : ?>
                                                <option class="text-warning" value="<?= $p['id_produk'] ?>" <?= $p['id_produk'] == set_value('id_produk[' . $a . ']') ? 'selected' : ''  ?>><?= $p['nama_produk'] ?> | Stok <?= $p['stok'] ?></option>
                                            <?php elseif ($p['stok'] <= 0) : ?>
                                                <option disabled class="text-danger" value="<?= $p['id_produk'] ?>" <?= $p['id_produk'] == set_value('id_produk[' . $a . ']') ? 'selected' : ''  ?>><?= $p['nama_produk'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $p['id_produk'] ?>" <?= $p['id_produk'] == set_value('id_produk[' . $a . ']') ? 'selected' : ''  ?>><?= $p['nama_produk'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                    <small class="text-danger"><?= form_error('id_produk') ?></small>
                                </div>
                                <div class="col-lg-2">
                                    <label for="exampleFormControlInput1">Jumlah</label>
                                    <input required type="number" name="jumlah_produk[]" value="<?= set_value('jumlah_produk') ?>" class="form-control" id="exampleFormControlInput1">
                                    <small class="text-danger"><?= form_error('jumlah_produk') ?></small>
                                </div>
                            </div>

                        </div>
                    <?php endfor ?>

                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>