<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Petugas</h1>
    <?= $this->session->flashdata('pesan') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data Petugas</h6>
            <a href="<?= base_url('admin/tambahpetugas') ?>" class="btn btn-success float-right"><i class="fas fa-user-plus"></i> Tambah Petugas</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($petugas as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#foto<?= $p['id_user'] ?>">
                                        <img src="<?= base_url('assets/img/petugas/' . $p['foto']) ?>" class="img-fluid" width="50" height="50" alt="tidak ada foto">
                                    </button>

                                </td>
                                <td><?= $p['nama'] ?></td>
                                <td><?= $p['jenis_kelamin'] ?></td>
                                <td><?= $p['alamat'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editpetugas/' . $p['id_user']) ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $p['id_user'] ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Hapus -->
<?php foreach ($petugas as $p) : ?>
    <div class="modal fade" id="hapus<?= $p['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/hapuspetugas/' . $p['id_user']) ?> " method="post">
                    <div class="modal-body">
                        Apakah anda yakin menghapus data petugas <b><?= $p['nama'] ?></b> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- Modal Foto -->
<?php foreach ($petugas as $p) : ?>
    <div class="modal fade" id="foto<?= $p['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Foto Petugas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="<?= base_url('assets/img/petugas/' . $p['foto']) ?>" alt="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>