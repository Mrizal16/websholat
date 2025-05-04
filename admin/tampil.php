<?php
include '../koneksi.php';

$sql = "SELECT * FROM bacaan_sholat ORDER BY jenis_sholat, urutan";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
<tr>
  <td><?= $row['JENIS_SHOLAT'] ?></td>
  <td><?= $row['NAMA_BACAAN'] ?></td>
  <td><?= nl2br($row['ARAB']) ?></td>
  <td><i><?= nl2br($row['LATIN']) ?></i></td>
  <td><?= nl2br($row['TERJEMAHAN']) ?></td>
  <td><?= $row['URUTAN'] ?></td>
  <td>
    <?php if (!empty($row['AUDIO'])): ?>
      <audio controls src="<?= $row['AUDIO'] ?>"></audio>
    <?php endif; ?>
  </td>
  <td>
    <a class="action-btn" href="admin.php?edit=<?= $row['ID'] ?>">Edit</a>
    <a class="action-btn" href="hapus.php?id=<?= $row['ID'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
