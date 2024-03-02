<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Petugas</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tambah Petugas</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/tambahpetugas') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Foto</label>
                        <input required type="file" name="foto" value="<?= set_value('foto') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('foto') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Petugas</label>
                        <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('nama') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?= "Laki-laki" == set_value('jenis_kelamin') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= "Perempuan" == set_value('jenis_kelamin') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <small class="text-danger"><?= form_error('jenis_kelamin') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"><?= set_value('alamat') ?></textarea>
                        <small class="text-danger"><?= form_error('alamat') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Username</label>
                        <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('username') ?></small>
                    </div>
                    <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                                <small class="text-danger"><?= form_error('password') ?></small>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Konfirmasi Password</label>
                                <input type="password" name="konformasi_password" class="form-control" id="exampleFormControlInput1">
                                <small class="text-danger"><?= form_error('konformasi_password') ?></small>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>

</div>