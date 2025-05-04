<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM sholat_sunnah WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}
header("Location: admin_sholat_sunnah.php");
exit;
