<?php
include "koneksi.php";

if (isset($_GET['nis'])) {
    $nis = mysqli_real_escape_string($koneksi, $_GET['nis']);
    
    $query = "SELECT * FROM siswa WHERE nis = '$nis'";
    $result = mysqli_query($koneksi, $query);
    
    header('Content-Type: application/json');
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'success' => true,
            'siswa' => $row
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Student not found'
        ]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'No NIS provided'
    ]);
}

mysqli_close($koneksi);
?>