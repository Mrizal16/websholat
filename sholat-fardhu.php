<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bacaan Sholat Fardhu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    header {
      background-color: #2c3e50;
      padding: 20px;
      text-align: center;
      color: white;
      font-size: 2em;
      font-weight: bold;
    }

    main {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 2.5em;
      text-align: center;
      color: #333;
    }

    ul {
      list-style: none;
      padding: 0;
      margin-top: 30px;
    }

    li {
      margin: 15px 0;
    }

    a {
      display: block;
      padding: 15px;
      font-size: 1.5em;
      text-decoration: none;
      color: #fff;
      background-color: #5c6bc0;
      border-radius: 8px;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    a:hover {
      background-color: #3f4f9a;
    }

    footer {
      background-color: #2c3e50;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .btn-kembali {
      display: inline-block;
      margin-bottom: 20px;
      padding: 10px 18px;
      background-color: #34495e;
      color: #fff;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }

    .btn-kembali:hover {
      background-color: #2c3e50;
    }
  </style>
</head>
<body>
  <header>
    Bacaan Sholat Fardhu
  </header>

  <main>
    <h1>Daftar Bacaan Sholat Fardhu</h1>
    <ul>
      <li><a href="sholat-subuh.php">Sholat Subuh</a></li>
      <li><a href="sholat-dzuhur.php">Sholat Dzuhur</a></li>
      <li><a href="sholat-ashar.php">Sholat Ashar</a></li>
      <li><a href="sholat-maghrib.php">Sholat Maghrib</a></li>
      <li><a href="sholat-isya.php">Sholat Isya</a></li>
    </ul>
    <br>
    <a href="index.html" class="btn-kembali">Kembali ke Halaman Utama</a>
  </main>

  <footer>

  </footer>
</body>
</html>
