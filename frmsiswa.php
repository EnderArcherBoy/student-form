<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Siswa</title>
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

        .bg-image {
            position: fixed;
            width: 20px;
            height: 20px;
            background: url('OIIANormal.webp') no-repeat center/contain;
            opacity: 1;
            z-index: -1;
            animation: move 10s linear infinite;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.95);
            margin-top: 2rem !important;
            position: relative;
            z-index: 1;
        }

        /* Keep existing form styles */
        .form-floating > .form-select {
            height: calc(3.5rem + 2px);
            padding: 1rem 0.75rem;
            line-height: 1.25;
        }
        
        .form-select option {
            padding: 0.5rem;
        }
    </style>
</head>

<body class="mt-5">

    <?php
    // Add this function at the top of your file
    function getSiswaValue($siswa, $key, $default = '') {
        return isset($siswa[$key]) ? htmlspecialchars($siswa[$key]) : $default;
    }

    $edit_mode = isset($_GET['edit']) && $_GET['edit'] === 'true';
    $nis = isset($_GET['nis']) ? $_GET['nis'] : '';

    if ($edit_mode && $nis) {
        include "koneksi.php";
        $query = "SELECT * FROM siswa WHERE nis = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $nis);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $siswa = mysqli_fetch_assoc($result);
        mysqli_close($koneksi);
    }
    ?>
    
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 50rem;">
            <div class="card-body shadow">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="OIIANormal.webp" width="50px" height="50px" alt="Logo" class="me-2">
                    <h5 class="card-title">Formulir Siswa</h5>
                    <img src="OIIANormal.webp" width="50px" height="50px" alt="Logo" class="me-2">
                </div>
                <hr>
                <form action="<?php echo $edit_mode ? 'update_siswa.php' : 'proses.php'; ?>" method="post" class="needs-validation" novalidate>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputNIS" type="text" name="nis" 
                               placeholder="Enter NIS" 
                               value="<?php echo $edit_mode ? getSiswaValue($siswa, 'nis') : ''; ?>"
                               <?php echo $edit_mode ? 'readonly' : ''; ?> required />
                        <label for="inputNIS">NIS</label>
                        <div class="invalid-feedback">NIS tidak boleh kosong</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputNama" type="text" placeholder="Enter your name"
                            name="nama" maxlength="50" 
                            value="<?php echo $edit_mode ? getSiswaValue($siswa, 'nama_siswa') : ''; ?>" required />
                        <label for="inputNama">Nama</label>
                        <div class="invalid-feedback">
                            Nama tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="selectGender" name="jk" required>
                            <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                            <option value="L" <?php echo $edit_mode && $siswa['jk'] === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="P" <?php echo $edit_mode && $siswa['jk'] === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            Silakan pilih jenis kelamin
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="inputAlamat" placeholder="Enter your address"
                            name="alamat" rows="5" required><?php echo $edit_mode ? getSiswaValue($siswa, 'alamat') : ''; ?></textarea>
                        <label for="inputAlamat">Address</label>
                        <div class="invalid-feedback">
                            Alamat tidak boleh kosong
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="inputTelepon" type="text" placeholder="Enter your phone"
                            name="telepon" maxlength="20" 
                            value="<?php echo $edit_mode ? getSiswaValue($siswa, 'telepon') : ''; ?>" required />
                        <label for="inputTelepon">No Telepon/HP</label>
                        <div class="invalid-feedback">
                            Nomor telepon tidak boleh kosong
                        </div>
                    </div>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary"><?php echo $edit_mode ? 'Update' : 'Kirim'; ?></button>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
            const jkSelect = document.querySelector('select[name="jk"]');
            const nisInput = document.querySelector('#inputNIS');

            // Custom validation for gender
            jkSelect.addEventListener('change', function () {
                if (this.value) {
                    this.classList.remove('is-invalid');
                }
            });

            // Add NIS validation on input
            nisInput.addEventListener('blur', async function() {
                if (this.value.trim()) {
                    try {
                        const response = await fetch('check_nis.php?nis=' + this.value);
                        const data = await response.json();
                        if (data.exists) {
                            this.classList.add('is-invalid');
                            this.nextElementSibling.nextElementSibling.textContent = 'NIS sudah terdaftar';
                        } else {
                            this.classList.remove('is-invalid');
                            this.nextElementSibling.nextElementSibling.textContent = 'NIS tidak boleh kosong';
                        }
                    } catch (error) {
                        console.error('Error checking NIS:', error);
                    }
                }
            });

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const inputs = form.querySelectorAll('input, textarea, select');
                let isValid = true;

                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                if (!form.checkValidity() || !isValid) {
                    e.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    const title = document.querySelector('.modal-title');
                    const body = document.querySelector('.modal-body');

                    if (data.status === 'success') {
                        title.textContent = 'Sukses';
                        body.textContent = data.message;
                        form.reset();
                        form.classList.remove('was-validated');
                        
                        // Redirect after successful submission
                        setTimeout(() => {
                            window.location.href = 'index.php';
                        }, 2000);
                    } else {
                        title.textContent = 'Gagal';
                        body.textContent = data.message || 'Terjadi kesalahan saat mengirim data';
                    }

                    modal.show();
                } catch (error) {
                    console.error('Error:', error);
                    document.querySelector('.modal-title').textContent = 'Error';
                    document.querySelector('.modal-body').textContent = 'Terjadi kesalahan saat mengirim data';
                    modal.show();
                }
            });

            document.getElementById('staticBackdrop').addEventListener('hidden.bs.modal', function () {
                document.querySelector('.modal-body').textContent = '';
            });

            function createRandomImage(index) {
                setTimeout(() => {
                    const img = document.createElement('div');
                    img.className = 'bg-image';
                    img.style.left = Math.random() * 100 + 'vw';
                    img.style.top = Math.random() * 100 + 'vh';
                    img.style.transform = `rotate(${Math.random() * 360}deg)`;
                    img.style.opacity = '0';
                    document.body.appendChild(img);

                    // Fade in effect
                    setTimeout(() => {
                        img.style.transition = 'opacity 0.5s, left 1s, top 1s, transform 1s';
                        img.style.opacity = '1';
                    }, 50);

                    // Function to move image randomly
                    function moveRandomly() {
                        img.style.left = Math.random() * 100 + 'vw';
                        img.style.top = Math.random() * 100 + 'vh';
                        img.style.transform = `rotate(${Math.random() * 360}deg)`;
                        img.style.opacity = '0';

                        setTimeout(() => {
                            img.style.opacity = '1';
                        }, 500);
                    }

                    // Move images periodically
                    setInterval(moveRandomly, 3000 + Math.random() * 2000); // Random interval between 3-5 seconds
                }, index * 20);
            }

            // Create background images with delay
            const totalImages = 500;
            for(let i = 0; i < totalImages; i++) {
                createRandomImage(i);
            }
        });
    </script>
</body>

</html>