<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="fsninmg.png" type="image/x-icon">
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
            margin-top: 2rem !important;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="mt-5">
    <?php
    include "koneksi.php";
    
    $nis = isset($_GET['nis']) ? $_GET['nis'] : '';
    $siswa = null;

    // validasi nis sama
    if ($nis) {
        $query = "SELECT * FROM siswa WHERE nis = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $nis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $siswa = mysqli_fetch_assoc($result);
    }

    if (!$siswa) {
        header("Location: index.php");
        exit;
    }
    ?>

    <div class="d-flex justify-content-center">
        <div class="card" style="width: 50rem;">
            <div class="card-body shadow">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="OIIANormal.webp" width="50px" height="50px" alt="Logo" class="me-2">
                    <h5 class="card-title">Edit Data Siswa</h5>
                    <img src="OIIANormal.webp" width="50px" height="50px" alt="Logo" class="me-2">
                </div>
                <hr>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php
                        switch($_GET['error']) {
                            case 'empty':
                                echo "All fields are required!";
                                break;
                            case 'duplicate':
                                echo "This NIS already exists in database!";
                                break;
                            case 'update':
                                echo "Error updating data!";
                                break;
                            default:
                                echo "An error occurred!";
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <form action="update_siswa.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="old_nis" value="<?php echo htmlspecialchars($nis); ?>">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputNIS" type="text" name="nis" 
                               value="<?php echo htmlspecialchars($siswa['nis']); ?>" required/>
                        <label for="inputNIS">NIS</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputNama" type="text" name="nama"
                               value="<?php echo htmlspecialchars($siswa['nama_siswa']); ?>" required />
                        <label for="inputNama">Nama</label>
                        <div class="invalid-feedback">Nama tidak boleh kosong</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="selectGender" name="jk" required>
                            <option value="L" <?php echo $siswa['jk'] === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="P" <?php echo $siswa['jk'] === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                        <label for="selectGender">Jenis Kelamin</label>
                        <div class="invalid-feedback">Pilih jenis kelamin</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="inputAlamat" name="alamat" 
                                  required><?php echo htmlspecialchars($siswa['alamat']); ?></textarea>
                        <label for="inputAlamat">Alamat</label>
                        <div class="invalid-feedback">Alamat tidak boleh kosong</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputTelepon" type="text" name="telepon"
                               value="<?php echo htmlspecialchars($siswa['telepon']); ?>" required />
                        <label for="inputTelepon">No Telepon/HP</label>
                        <div class="invalid-feedback">Nomor telepon tidak boleh kosong</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
    // Form validation
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>
</html>