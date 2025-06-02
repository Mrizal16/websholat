<?php
include '../koneksi.php';

// Ambil data bacaan sholat Witir dan urutkan berdasarkan urutan
$sql = "SELECT * FROM sholat_sunnah WHERE jenis_sholat = 'Witir' ORDER BY urutan ASC";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tatacara & Bacaan Sholat Witir</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f9;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .bacaan-container {
      background-color: #fff;
      padding: 20px;
      margin-top: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .bacaan-item {
      margin-bottom: 20px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
    }

    .bacaan-item h3 {
      color: #5c6bc0;
      font-size: 24px;
    }

    .bacaan-item p {
      font-size: 18px;
      line-height: 1.6;
      color: #555;
    }

    .bacaan-item audio {
      margin-top: 10px;
      width: 100%;
    }

    .bacaan-item .urutan {
      font-weight: bold;
      color: #333;
      margin-top: 10px;
      font-size: 20px;
    }

    .bacaan-item .details {
      display: none;
      margin-top: 20px;
    }

    .bacaan-item.active .details {
      display: block;
    }

    .bacaan-item button {
      padding: 15px 0;
      background-color: #5c6bc0;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .bacaan-item button:hover {
      background-color: #3f4f9a;
    }

    .btn-kembali {
      display: inline-block;
      margin-top: 20px;
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
  <script>
    function toggleDetails(id) {
      const bacaanItem = document.getElementById(id);
      bacaanItem.classList.toggle('active');
    }
  </script>
</head>
<body>
  <h1>Tatacara & Bacaan Sholat Witir</h1>

  <div class="bacaan-container">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <div class="bacaan-item" id="bacaan-<?= $row['URUTAN'] ?>">
        <div class="urutan">
          <button onclick="toggleDetails('bacaan-<?= $row['URUTAN'] ?>')">
            Urutan: <?= $row['URUTAN'] ?> - <?= htmlspecialchars($row['NAMA_BACAAN']) ?>
          </button>
        </div>

        <div class="details">
          <?php 
            $arab = is_resource($row['ARAB']) ? stream_get_contents($row['ARAB']) : $row['ARAB'];
            $latin = is_resource($row['LATIN']) ? stream_get_contents($row['LATIN']) : $row['LATIN'];
            $terjemahan = is_resource($row['TERJEMAHAN']) ? stream_get_contents($row['TERJEMAHAN']) : $row['TERJEMAHAN'];
            $audioPath = !empty($row['AUDIO']) ? '/tuntunan-sholat-full/' . $row['AUDIO'] : '';
          ?>

          <p style="font-size:30px; color: #004d40"><?= nl2br(htmlspecialchars($arab)) ?></p>
          <p><i><?= nl2br(htmlspecialchars($latin)) ?></i></p>
          <p><?= nl2br(htmlspecialchars($terjemahan)) ?></p>

          <?php if (!empty($audioPath)): ?>
            <audio controls src="<?= htmlspecialchars($audioPath) ?>"></audio>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
    <a href="../sholat-sunnah.php" class="btn-kembali">Kembali</a>
  </div>

</body>
</html>
