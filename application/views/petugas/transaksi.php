<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Transaksi</h1>
    <?= $this->session->flashdata('pesan') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Penjualan</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $t['id_penjualan'] ?></td>
                                <td><?= $t['nama'] ?></td>
                                <td><?= date('d-m-Y', strtotime($t['tanggal_penjualan'])) ?></td>
                                <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.')  ?></td>
                                <td>
                                    <a href="<?= base_url('petugas/detailpenjualan/' . $t['id_penjualan']) ?>" class="btn btn-success btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
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
<!-- <?php foreach ($telanggan as $t) : ?>
    <div class="modal fade" id="hapus<?= $t['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/hapuspelanggan/' . $t['id_pelanggan']) ?> " method="post">
                    <div class="modal-body">
                        Apakah anda yakin menghapus data pelanggan <b><?= $t['nama'] ?></b> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?> -->