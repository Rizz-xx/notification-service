# Notification Service (Kelompok 6)

Layanan Notifikasi berbasis microservices yang dirancang menggunakan PHP Native dan MySQL. Layanan ini berfungsi untuk menerima, menyimpan, dan menampilkan notifikasi yang dikirimkan oleh service lain (khususnya Kelompok 5: Submission/File).

---

## 🛠️ Tools & Persyaratan Sistem

Sebelum menjalankan proyek ini, pastikan Anda telah menginstal tools berikut:

- **XAMPP** (Apache Web Server & MySQL Database)
- **PHP** version 7.4 / 8.x
- **Postman** (Opsional, untuk pengujian API)
- Web Browser (Chrome / Firefox / Edge)

---

## 🚀 Cara Penginstalan & Jalur Proyek

1. **Jalankan XAMPP Control Panel**
   - Aktifkan modul **Apache** dan **MySQL**.

2. **Kloning / Salin Kode Proyek**
   - Pastikan folder proyek diletakkan di dalam direktori `htdocs`:
     `C:\xampp\htdocs\notification-service\`

3. **Pengaturan Database**
   - Buka browser dan akses **phpMyAdmin** di `http://localhost/phpmyadmin/`.
   - Buat database baru bernama: `db_notifikasi`.
   - Buat tabel bernama `notification` dengan struktur berikut:
     - `id` (INT, Primary Key, AUTO_INCREMENT)
     - `recipient` (VARCHAR 100)
     - `message` (TEXT)
     - `created_at` (TIMESTAMP, default: `CURRENT_TIMESTAMP`)

---

## 📑 Kontrak API (Untuk Kelompok 5 & Client)

**Base URL:** `http://localhost/notification/api.php`

### 1. Mengirim Notifikasi Baru (Kelompok 5 -> Kelompok 6)

Digunakan oleh Kelompok 5 untuk memicu/mengirimkan pesan notifikasi baru saat ada aktivitas submission file.

- **Method:** `POST`
- **URL:** `http://localhost/notification-service/api.php`
- **Headers:** `Content-Type: application/x-www-form-urlencoded`
- **Body Parameters:**

| Parameter   | Tipe Data | Keterangan                                  | Contoh                                     |
| :---------- | :-------- | :------------------------------------------ | :----------------------------------------- |
| `recipient` | String    | Nama atau identitas penerima notifikasi     | `Budi`                                     |
| `message`   | String    | Isi pesan notifikasi yang ingin disampaikan | `File tugas matematika berhasil diunggah.` |

- **Response (Success - 200 OK):**

```json
{
  "status": "success",
  "message": "Notifikasi berhasil disimpan"
}
```

- **Response (Error - Bad Request):**

```json
{
  "status": "error",
  "message": "Recipient dan message wajib diisi"
}
```

---

### 2. mengambil Daftar Notifikasi

Digunakan untuk mengambil seluruh riwayat notifikasi yang tersimpan di dalam database.

- **Method:** `GET`
- **URL:** `http://localhost/notification-service/api.php`
- **Response (Success - 200 OK):**

```json
{
  "status": "success",
  "data": [
    {
      "id": "1",
      "recipient": "Budi",
      "message": "File tugas matematika berhasil diunggah.",
      "created_at": "2026-10-26 17:30:00"
    }
  ]
}
```

---

### 3. Menghapus Notifikasi

Digunakan untuk menghapus notifikasi berdasarkan ID tertentu.

- **Method:** `DELETE`
- **URL:** `http://localhost/notification-service/api.php`
- **Headers:** `Content-Type: application/x-www-form-urlencoded`
- **Body Parameters:**

| Parameter | Tipe Data | Keterangan                            | Contoh |
| :-------- | :-------- | :------------------------------------ | :----- |
| `id`      | Integer   | ID unik notifikasi yang ingin dihapus | `1`    |

- **Response (Success - 200 OK):**

```json
{
  "status": "success",
  "message": "Notifikasi berhasil dihapus"
}
```
