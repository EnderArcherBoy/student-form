<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
    $old_nis = mysqli_real_escape_string($koneksi, $_POST['old_nis']);
    $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    // Validate required fields
    if (empty($new_nis) || empty($nama_siswa) || empty($jk) || empty($alamat) || empty($telepon)) {
        header("Location: frmedit.php?nis=$old_nis&error=empty");
        exit;
    }

    // Check if NIS is being changed and verify for duplicates
    if ($new_nis !== $old_nis) {
        $check_sql = "SELECT nis FROM siswa WHERE nis = ?";
        $check_stmt = mysqli_prepare($koneksi, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $new_nis);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            mysqli_stmt_close($check_stmt);
            header("Location: frmedit.php?nis=$old_nis&error=duplicate");
            exit;
        }
        mysqli_stmt_close($check_stmt);
    }

    // Update student data including NIS
    $sql = "UPDATE siswa SET nis=?, nama_siswa=?, jk=?, alamat=?, telepon=? WHERE nis=?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $new_nis, $nama_siswa, $jk, $alamat, $telepon, $old_nis);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?success=update");
    } else {
        header("Location: frmedit.php?nis=$old_nis&error=update");
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($koneksi);
?>