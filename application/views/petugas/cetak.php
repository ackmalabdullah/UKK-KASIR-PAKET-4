<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .text-left {
            text-align: left;
        }

        th {
            background-color: yellow;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            margin: auto;
        }
    </style>
</head>

<body>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th class="text-left" colspan="4">ID Penjualan : <?= $penjualan[0]['id_penjualan'] ?></th>
        </tr>
        <tr>
            <th class="text-left" colspan="4">Nama Pelanggan : <?= $penjualan[0]['nama'] ?></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Sub Total</th>
        </tr>
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
            <th class="text-left" colspan="3">Total Keseluruhan</th>
            <th>Rp <?= number_format($total, 0, ',', '.')  ?></th>
        </tr>
        <tr>
            <th class="text-left" colspan="3">Bayar</th>
            <th>Rp <?= number_format($penjualan[0]['bayar'], 0, ',', '.')  ?></th>
        </tr>
        <tr>
            <th class="text-left" colspan="3">Kembalian</th>
            <th>Rp <?= number_format($penjualan[0]['bayar'] - $total, 0, ',', '.') ?></th>
        </tr>
    </table>
</body>

</html>