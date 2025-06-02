<?php
require '../koneksi.php';

$id           = $_POST['id'] ?? null;
$jenis_sholat = $_POST['jenis_sholat'];
$nama_bacaan  = $_POST['nama_bacaan'];
$arab         = $_POST['arab'];
$latin        = $_POST['latin'];
$terjemahan   = $_POST['terjemahan'];
$urutan       = $_POST['urutan'];

// Proses upload audio
$audio_path = null;
if (!empty($_FILES['audio']['name'])) {
    $audio_name = time() . "_" . basename($_FILES['audio']['name']);
    $target_dir = "../uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir);
    $target_file = $target_dir . $audio_name;
    move_uploaded_file($_FILES['audio']['tmp_name'], $target_file);
    $audio_path = "uploads/" . $audio_name;
}

if ($id) {
    $sql = "UPDATE sholat_sunnah SET 
                jenis_sholat = :jenis_sholat, 
                nama_bacaan = :nama_bacaan, 
                arab = :arab, 
                latin = :latin, 
                terjemahan = :terjemahan, 
                urutan = :urutan";

    if ($audio_path) {
        $sql .= ", audio = :audio";
    }

    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':jenis_sholat', $jenis_sholat);
    $stmt->bindParam(':nama_bacaan', $nama_bacaan);
    $stmt->bindParam(':arab', $arab);
    $stmt->bindParam(':latin', $latin);
    $stmt->bindParam(':terjemahan', $terjemahan);
    $stmt->bindParam(':urutan', $urutan);
    if ($audio_path) $stmt->bindParam(':audio', $audio_path);
    $stmt->bindParam(':id', $id);
} else {
    // Insert
    $sql = "INSERT INTO sholat_sunnah 
                (jenis_sholat, nama_bacaan, arab, latin, terjemahan, urutan, audio)
            VALUES (:jenis_sholat, :nama_bacaan, :arab, :latin, :terjemahan, :urutan, :audio)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':jenis_sholat', $jenis_sholat);
    $stmt->bindParam(':nama_bacaan', $nama_bacaan);
    $stmt->bindParam(':arab', $arab);
    $stmt->bindParam(':latin', $latin);
    $stmt->bindParam(':terjemahan', $terjemahan);
    $stmt->bindParam(':urutan', $urutan);
    $stmt->bindParam(':audio', $audio_path);
}

$stmt->execute();
header("Location: admin_sholat_sunnah.php");
exit;
?>
