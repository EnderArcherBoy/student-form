<?php
include "koneksi.php";

if (isset($_GET['nis'])) {
    $nis = mysqli_real_escape_string($koneksi, $_GET['nis']);
    
    $query = "SELECT COUNT(*) as count FROM siswa WHERE nis = '$nis'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    
    header('Content-Type: application/json');
    echo json_encode(['exists' => $row['count'] > 0]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'No NIS provided']);
}

mysqli_close($koneksi);
?>