<?php
include('koneksi.php');

// Sample data for seeding
$students = [
    ['nis' => '101', 'nama_siswa' => 'John Doe', 'jk' => 'L', 'alamat' => '123 Main St', 'telepon' => '123456789'],
    ['nis' => '102', 'nama_siswa' => 'Jane Smith', 'jk' => 'P', 'alamat' => '456 Elm St', 'telepon' => '987654321'],
    ['nis' => '103', 'nama_siswa' => 'Bob Johnson', 'jk' => 'L', 'alamat' => '789 Oak St', 'telepon' => '555123456'],
    ['nis' => '104', 'nama_siswa' => 'Alice Brown', 'jk' => 'P', 'alamat' => '321 Pine St', 'telepon' => '555987654'],
    ['nis' => '105', 'nama_siswa' => 'Mike Davis', 'jk' => 'L', 'alamat' => '901 Maple St', 'telepon' => '555111222'],
    ['nis' => '106', 'nama_siswa' => 'Sarah Taylor', 'jk' => 'P', 'alamat' => '234 Cherry St', 'telepon' => '555333444'],
    ['nis' => '107', 'nama_siswa' => 'Emily Lee', 'jk' => 'P', 'alamat' => '567 Walnut St', 'telepon' => '555555555'],
    ['nis' => '108', 'nama_siswa' => 'David Kim', 'jk' => 'L', 'alamat' => '890 Cedar St', 'telepon' => '555666666'],
    ['nis' => '109', 'nama_siswa' => 'Olivia Martin', 'jk' => 'P', 'alamat' => '345 Spruce St', 'telepon' => '555777777'],
    ['nis' => '110', 'nama_siswa' => 'Benjamin White', 'jk' => 'L', 'alamat' => '678 Cypress St', 'telepon' => '555888888'],
    ['nis' => '111', 'nama_siswa' => 'Abigail Hall', 'jk' => 'P', 'alamat' => '9010 Magnolia St', 'telepon' => '555999999'],
    ['nis' => '112', 'nama_siswa' => 'Hannah Lewis', 'jk' => 'P', 'alamat' => '2345 Peachtree St', 'telepon' => '555101010'],
    ['nis' => '113', 'nama_siswa' => 'Alexander Brooks', 'jk' => 'L', 'alamat' => '4567 Park Ave', 'telepon' => '555111111'],
    ['nis' => '114', 'nama_siswa' => 'Samantha Jackson', 'jk' => 'P', 'alamat' => '6789 Main St', 'telepon' => '555222222'],
    // Add more sample data as needed
];

foreach ($students as $student) {
    $sql = "INSERT INTO siswa (nis, nama_siswa, jk, alamat, telepon)
    VALUES ('{$student['nis']}', '{$student['nama_siswa']}', '{$student['jk']}', '{$student['alamat']}', '{$student['telepon']}')";
    
    if ($koneksi->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

