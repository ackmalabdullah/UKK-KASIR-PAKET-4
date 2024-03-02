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

        .text-center {
            text-align: center;
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
    <h3 class="text-center">Laporan Kasir Mulai Tanggal <?= date('d-m-Y', strtotime($tanggal['awal']))  ?> Sampai Tanggal <?= date('d-m-Y', strtotime($tanggal['akhir']))  ?></h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>ID Penjualan</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Total Bayar</th>
        </tr>
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
    </table>
</body>

</html>