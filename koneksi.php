<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost"; 
$port = "1521";
$sid = "orclpdb";  
$username = "myapp";  
$password = "mypassword";

try {
    // Koneksi ke database Oracle menggunakan PDO
    $pdo = new PDO("oci:dbname=//$host:$port/$sid;charset=UTF8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //echo "✅ Koneksi ke database berhasil!<br>";  // Hapus ini jika tidak ingin menampilkan di setiap halaman
} catch (PDOException $e) {
    die(json_encode(["success" => false, "message" => "Database Connection Failed: " . $e->getMessage()]));
}
?>
