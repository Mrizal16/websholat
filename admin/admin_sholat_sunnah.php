<?php
require '../koneksi.php';

$data = [];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM sholat_sunnah WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $data = [
        'ID' => $row['ID'],
        'JENIS_SHOLAT' => $row['JENIS_SHOLAT'],
        'NAMA_BACAAN' => $row['NAMA_BACAAN'],
        'ARAB' => is_resource($row['ARAB']) ? stream_get_contents($row['ARAB']) : $row['ARAB'],
        'LATIN' => is_resource($row['LATIN']) ? stream_get_contents($row['LATIN']) : $row['LATIN'],
        'TERJEMAHAN' => is_resource($row['TERJEMAHAN']) ? stream_get_contents($row['TERJEMAHAN']) : $row['TERJEMAHAN'],
        'URUTAN' => $row['URUTAN'],
        'AUDIO' => $row['AUDIO']
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - CRUD Bacaan Sholat Sunnah</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
      color: #333;
    }

    header h1 {
      text-align: center;
      color: #2c3e50;
    }

    form {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      max-width: 700px;
      margin: 0 auto 30px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 15px;
    }

    label input[type="text"],
    label input[type="number"],
    label select,
    label textarea {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
      box-sizing: border-box;
    }

    textarea {
      height: 80px;
      resize: vertical;
    }

    button {
      background-color: #3498db;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
      vertical-align: top;
      font-size: 14px;
    }

    th {
      background-color: #f1f1f1;
    }

    .action-btn {
      text-decoration: none;
      background-color: #2ecc71;
      color: white;
      padding: 6px 10px;
      border-radius: 5px;
      font-size: 13px;
      margin-right: 5px;
    }

    .action-btn:hover {
      background-color: #27ae60;
    }

    .action-btn:last-child {
      background-color: #e74c3c;
    }

    .action-btn:last-child:hover {
      background-color: #c0392b;
    }

    audio {
      max-width: 150px;
    }

    h2 {
      margin-top: 40px;
      color: #2c3e50;
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
    <h1>Halaman Admin - Bacaan Sholat Sunnah</h1>
  </header>
  <main>
    <form action="simpan-sunnah.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $data['ID'] ?? '' ?>">

      <label>Jenis Sholat:
        <select name="jenis_sholat" required>
          <option value="">Pilih...</option>
          <?php
            $sholat = ['Dhuha', 'Tahajud', 'Witir', 'Taubat'];
            foreach ($sholat as $s) {
              $selected = (isset($data['JENIS_SHOLAT']) && $data['JENIS_SHOLAT'] == $s) ? 'selected' : '';
              echo "<option value='$s' $selected>$s</option>";
            }
          ?>
        </select>
      </label><br><br>

      <label>Nama Bacaan:<br>
        <input type="text" name="nama_bacaan" value="<?= htmlspecialchars($data['NAMA_BACAAN'] ?? '') ?>" required>
      </label><br><br>

      <label>Arab:<br>
        <textarea name="arab" required><?= htmlspecialchars($data['ARAB'] ?? '') ?></textarea>
      </label><br><br>

      <label>Latin:<br>
        <textarea name="latin" required><?= htmlspecialchars($data['LATIN'] ?? '') ?></textarea>
      </label><br><br>

      <label>Terjemahan:<br>
        <textarea name="terjemahan" required><?= htmlspecialchars($data['TERJEMAHAN'] ?? '') ?></textarea>
      </label><br><br>

      <label>Urutan:<br>
        <input type="number" name="urutan" value="<?= $data['URUTAN'] ?? '' ?>" required>
      </label><br><br>

      <label>Audio (MP3):<br>
        <input type="file" name="audio" accept="audio/*">
        <?php if (!empty($data['AUDIO'])): ?>
          <br><audio controls src="<?= $data['AUDIO'] ?>"></audio>
        <?php endif; ?>
      </label><br><br>

      <button type="submit"><?= isset($data['ID']) ? 'Update' : 'Simpan' ?></button>
    </form>

    <h2>Data Bacaan Sholat Sunnah</h2>
    <table>
      <thead>
        <tr>
          <th>Sholat</th><th>Nama Bacaan</th><th>Arab</th><th>Latin</th>
          <th>Terjemahan</th><th>Urutan</th><th>Audio</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $pdo->query("SELECT * FROM sholat_sunnah ORDER BY jenis_sholat, urutan");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $arab = is_resource($row['ARAB']) ? stream_get_contents($row['ARAB']) : $row['ARAB'];
          $latin = is_resource($row['LATIN']) ? stream_get_contents($row['LATIN']) : $row['LATIN'];
          $terjemahan = is_resource($row['TERJEMAHAN']) ? stream_get_contents($row['TERJEMAHAN']) : $row['TERJEMAHAN'];

          echo "<tr>
            <td>{$row['JENIS_SHOLAT']}</td>
            <td>{$row['NAMA_BACAAN']}</td>
            <td>" . nl2br(htmlspecialchars($arab)) . "</td>
            <td>" . nl2br(htmlspecialchars($latin)) . "</td>
            <td>" . nl2br(htmlspecialchars($terjemahan)) . "</td>
            <td>{$row['URUTAN']}</td>
            <td>";
              if (!empty($row['AUDIO'])) {
                  echo "<audio controls src='{$row['AUDIO']}'></audio>";
              }
          echo "</td>
            <td>
              <a class='action-btn' href='admin_sholat_sunnah.php?edit={$row['ID']}'>Edit</a>
              <a class='action-btn' href='hapus-sunnah.php?id={$row['ID']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
            </td>
          </tr>";
        }
        ?>
      </tbody>
    </table>
    <br>
    <a href="../admin.html" class="btn-kembali">Kembali ke Halaman Utama</a>
  </main>
</body>
</html>
