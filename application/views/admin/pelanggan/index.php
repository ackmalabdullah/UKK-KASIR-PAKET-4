<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Pelanggan</h1>
    <?= $this->session->flashdata('pesan') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data Pelanggan</h6>
            <a href="<?= base_url('admin/tambahpelanggan') ?>" class="btn btn-success float-right"><i class="fas fa-user-plus"></i> Tambah Pelanggan</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pelanggan</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pelanggan as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['id_pelanggan'] ?></td>
                                <td><?= $p['nama'] ?></td>
                                <td><?= $p['alamat'] ?></td>
                                <td><?= $p['no_telepon'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editpelanggan/' . $p['id_pelanggan']) ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $p['id_pelanggan'] ?>">
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
<?php foreach ($pelanggan as $p) : ?>
    <div class="modal fade" id="hapus<?= $p['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/hapuspelanggan/' . $p['id_pelanggan']) ?> " method="post">
                    <div class="modal-body">
                        Apakah anda yakin menghapus data pelanggan <b><?= $p['nama'] ?></b> ?
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