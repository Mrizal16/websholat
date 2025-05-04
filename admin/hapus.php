<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM bacaan_sholat WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
}
header("Location: admin.php");
exit;
