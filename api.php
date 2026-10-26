<?php
header("Content-Type: application/json; charset=UTF-8");
include "koneksi.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    // 1. GET: Mengambil semua data notifikasi
    case 'GET':
        $result = mysqli_query($conn, "SELECT * FROM notification ORDER BY id DESC");
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
        break;

    // 2. POST: Menerima/membuat notifikasi baru
    case 'POST':
        $recipient = $_POST['recipient'] ?? '';
        $message = $_POST['message'] ?? '';

        if (!empty($recipient) && !empty($message)) {
            $query = "INSERT INTO notification (recipient, message) VALUES ('$recipient', '$message')";
            if (mysqli_query($conn, $query)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Notifikasi berhasil disimpan"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menyimpan ke database"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Recipient dan message wajib diisi"
            ]);
        }
        break;

    // 3. DELETE: Menghapus notifikasi berdasarkan ID
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'] ?? '';

        if (!empty($id)) {
            $query = "DELETE FROM notification WHERE id = '$id'";
            if (mysqli_query($conn, $query)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Notifikasi berhasil dihapus"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menghapus data"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "ID tidak ditemukan"
            ]);
        }
        break;

    default:
        echo json_encode([
            "status" => "error",
            "message" => "Metode tidak didukung"
        ]);
        break;
}
?>