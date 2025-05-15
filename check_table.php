<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "10sija2";  // Changed database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if table exists
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'siswa'");

if (mysqli_num_rows($table_check) == 0) {
    // Create table if it doesn't exist
    $sql = "CREATE TABLE siswa (
        nis VARCHAR(20) PRIMARY KEY,
        nama VARCHAR(50) NOT NULL,
        jk ENUM('L','P') NOT NULL,
        alamat TEXT NOT NULL,
        telepon VARCHAR(15) NOT NULL
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table 'siswa' created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
} else {
    echo "Table 'siswa' already exists";
    
    // Show table structure
    $result = mysqli_query($conn, "DESCRIBE siswa");
    echo "<pre>\nTable structure:\n";
    while ($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
    echo "</pre>";
}

mysqli_close($conn);
?>