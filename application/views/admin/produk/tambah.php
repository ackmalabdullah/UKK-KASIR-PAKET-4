<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Produk</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tambah Produk</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/tambahproduk') ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Produk</label>
                        <input type="text" name="nama_produk" value="<?= set_value('nama_produk') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('nama_produk') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga</label>
                        <input type="number" name="harga" value="<?= set_value('harga') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('harga') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Stok</label>
                        <input type="number" name="stok" value="<?= set_value('stok') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('stok') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>