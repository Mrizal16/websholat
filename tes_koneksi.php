<?php
$conn = oci_connect("myapp", "mypassword", "//localhost:1521/orclpdb");
if (!$conn) {
    $e = oci_error();
    echo json_encode(["success" => false, "message" => $e['message']]);
} else {
    echo json_encode(["success" => true, "message" => "✅ Koneksi ke Oracle berhasil via oci_connect()"]);
}
?>
