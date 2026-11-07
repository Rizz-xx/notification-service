<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_notifications";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal"]));
}
?>