<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pelanggan</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Edit Pelanggan</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/editpelanggan/' . $pelanggan['id_pelanggan']) ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID Pelanggan</label>
                        <input readonly type="text" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('id_pelanggan') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Pelanggan</label>
                        <input type="text" name="nama" value="<?= $pelanggan['nama'] ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('nama') ?></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"><?= $pelanggan['alamat'] ?></textarea>
                        <small class="text-danger"><?= form_error('alamat') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">No Telepon</label>
                        <input type="number" name="no_telepon" value="<?= $pelanggan['no_telepon'] ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('no_telepon') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>