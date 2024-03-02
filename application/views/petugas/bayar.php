<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Penjualan</h1>
    <?= $this->session->flashdata('pesan') ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Data Penjualan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="4">ID Penjualan : <?= $penjualan[0]['id_penjualan'] ?></th>
                        </tr>
                        <tr>
                            <th colspan="4">Nama Pelanggan : <?= $penjualan[0]['nama'] ?></th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $no = 1;
                        foreach ($penjualan as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['nama_produk'] ?></td>
                                <td><?= $p['jumlah_produk'] ?> x Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                <?php $sub_total = $p['jumlah_produk'] * $p['harga'] ?>
                                <td>Rp <?= number_format($sub_total, 0, ',', '.') ?></td>
                                <?php $total += $sub_total ?>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <th colspan="3">Total Keseluruhan</th>
                            <th>Rp <?= number_format($total, 0, ',', '.')  ?></th>
                        </tr>
                        <form action="<?= base_url('petugas/bayar/' . $penjualan[0]['id_penjualan']) ?>" method="post">
                            <tr>
                                <th colspan="3">Bayar</th>
                                <th><input type="number" class="form-control" name="bayar"></th>
                                <input type="hidden" name="total_bayar" value="<?= $total ?>">
                            </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success float-right">Bayar</button>
                </form>
            </div>
        </div>
    </div>
</div>