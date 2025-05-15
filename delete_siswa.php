<?php
include "koneksi.php";

if (isset($_GET['nis'])) {
    $nis = mysqli_real_escape_string($koneksi, $_GET['nis']);
    
    $query = "DELETE FROM siswa WHERE nis = '$nis'";
    $result = mysqli_query($koneksi, $query);
    
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Student deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting student']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'No NIS provided']);
}

mysqli_close($koneksi);
?>