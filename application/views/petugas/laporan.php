<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan Penjualan</h1>

    <div class="col-lg-9 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Filter Tanggal</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('petugas/laporan') ?>" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Awal</label>
                        <input required type="date" value="<?= $tanggal['awal'] ?>" name="tanggal_awal" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('tanggal_awal') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Akhir</label>
                        <input required type="date" value="<?= $tanggal['akhir'] ?>" name="tanggal_akhir" class="form-control" id="exampleFormControlInput1">
                        <small class="text-danger"><?= form_error('tanggal_akhir') ?></small>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Kirim</button>
                    <a href="<?= base_url('petugas/laporan') ?>" class="btn btn-secondary">Reset</a>
                </form>
            </div>
        </div>
    </div>

    <?php if ($transaksi != null) : ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Data Transaksi Mulai Tanggal <?= date('d-m-Y', strtotime($tanggal['awal']))  ?> Sampai Tanggal <?= date('d-m-Y', strtotime($tanggal['akhir']))  ?></h6>
                <a target="_blank" href="<?= base_url('petugas/cetaklaporan/' . $tanggal['awal'] . '/' . $tanggal['akhir']) ?>" class="btn btn-success float-right"><i class="fas fa-print"></i> Cetak</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Penjualan</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Total Bayar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $no = 1;
                            foreach ($transaksi as $t) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $t['id_penjualan'] ?></td>
                                    <td><?= $t['nama'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($t['tanggal_penjualan'])) ?></td>
                                    <td>Rp <?= number_format($t['total_bayar'], 0, ',', '.')  ?></td>
                                </tr>
                                <?php $total += $t['total_bayar'] ?>
                            <?php endforeach ?>
                            <tr>
                                <th colspan="4">Total</th>
                                <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>

</div>