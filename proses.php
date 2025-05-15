<?php
include "koneksi.php";

header('Content-Type: application/json');

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
        $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

        // Validate required fields
        if (empty($nis) || empty($nama_siswa) || empty($jk) || empty($alamat) || empty($telepon)) {
            throw new Exception('Semua field harus diisi');
        }

        // Check for duplicate NIS
        $check_query = "SELECT COUNT(*) as count FROM siswa WHERE nis = ?";
        $stmt = mysqli_prepare($koneksi, $check_query);
        mysqli_stmt_bind_param($stmt, "s", $nis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'NIS sudah terdaftar'
            ]);
            exit;
        }

        // Insert data
        $sql = "INSERT INTO siswa (nis, nama_siswa, jk, alamat, telepon) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $nis, $nama_siswa, $jk, $alamat, $telepon);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        } else {
            throw new Exception(mysqli_error($koneksi));
        }
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}

mysqli_close($koneksi);
?>
