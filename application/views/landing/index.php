<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <style>
    /* Style untuk tampilan yang lebih menarik */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f2f2f2;
    }

    header {
      background-color: #45a049;
      color: #fff;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    nav {
      background-color: #444;
      text-align: center;
      padding: 10px 0;
    }

    /* Gaya untuk tombol login */
    nav a {
      color: #fff;
      text-decoration: none;
      padding: 15px 30px;
      /* Mengubah padding agar tombol lebih besar */
      background-color: #4CAF50;
      /* Warna latar belakang */
      border: none;
      border-radius: 50px;
      /* Mengubah border-radius agar tombol menjadi lingkaran */
      cursor: pointer;
      transition: all 0.3s ease;
      /* Efek transisi */
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      /* Efek bayangan */
      font-size: 18px;
      /* Mengubah ukuran teks */
    }

    /* Efek hover pada tombol login */
    nav a:hover {
      background-color: #45a049;
      /* Warna latar belakang saat hover */
      transform: scale(1.05);
      /* Memperbesar tombol saat hover */
      box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
      /* Efek bayangan saat hover */
    }

    section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      padding: 20px;
      align-items: center;
      /* Pusatkan vertikal */
    }

    .section-image {
      flex: 1;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      display: flex;
      justify-content: center;
      /* Memusatkan secara horizontal */
      align-items: center;
      /* Memusatkan secara vertikal */
    }

    .image-container {
      max-width: 100%;
      max-height: 300px;
      /* Atur tinggi maksimum gambar */
      display: flex;
      justify-content: center;
      /* Memusatkan gambar di dalam container */
      align-items: center;
      /* Memusatkan gambar di dalam container */
    }

    .card-img {
      max-width: 100%;
      max-height: 100%;
      /* Memastikan gambar tidak melebihi container */
      border-radius: 10px;
    }

    /* Menambahkan ruang di sekitar teks */
    .section-content {
      flex: 1;
      /* Biarkan konten ini memperluas sesuai kebutuhan */
      padding: 20px;
      /* Tambahkan padding */
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .btn {
      color: #fff;
      text-decoration: none;
      padding: 15px 30px;
      background-color: #4CAF50;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 18px;
    }

    .btn:hover {
      background-color: #45a049;
      transform: scale(1.05);
      box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
    }

    h2 {
      margin-top: 0;
    }

    p {
      color: #555;
    }

    /* Tambahkan margin atas pada tombol login */
    nav a {
      margin-top: 20px;
    }
  </style>
</head>

<body>

  <header>
    <h1>Halaman Landing Page</h1>
  </header>

  <section>

    <div class="section-content">
      <h2>Selamat datang di Aplikasi Kasir</h2>
      <p>Selamat datang di halaman landing page untuk aplikasi kasir kami. Aplikasi ini dirancang untuk memudahkan Anda dalam mengelola transaksi kasir dengan cepat dan efisien.
        Mulai Gunakan Sekarang!
        Jangan ragu untuk mencoba aplikasi kasir kami sekarang juga. Klik tombol di bawah untuk mulai menggunakan aplikasi dan nikmati kemudahan dalam mengelola bisnis Anda.
      </p>
      <!-- Konten lainnya seperti gambar atau deskripsi bisa ditambahkan di sini -->
      <a href="<?php echo base_url('auth/index'); ?>" class="btn">Get Started</a>
    </div>

    <div class="section-image">
      <div class="image-container">
        <img src="<?= base_url('assets/img/kasir3.png') ?>" alt="" class="card-img">
      </div>
    </div>

  </section>

</body>

</html>