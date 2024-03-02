<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Petugas</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Edit Petugas</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/editpetugas/' . $petugas['id_user']) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $petugas['foto'] ?>" name="foto_lama">
                    <div class="form-group">
                        <img src="<?= base_url('assets/img/petugas/' . $petugas['foto']) ?>" class="img-fluid" alt="">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Foto</label>
                        <input type="file" name="foto" value="<?= set_value('foto') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('foto') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Petugas</label>
                        <input type="text" name="nama" value="<?= $petugas['nama'] ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('nama') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?= "Laki-laki" == $petugas['jenis_kelamin'] ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= "Perempuan" == $petugas['jenis_kelamin'] ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <small class="text-danger"><?= form_error('jenis_kelamin') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"><?= $petugas['alamat'] ?></textarea>
                        <small class="text-danger"><?= form_error('alamat') ?></small>
                    </div>

                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>