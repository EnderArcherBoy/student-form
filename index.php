<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Management</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="icon" href="fsninmg.png" type="image/x-icon">
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            transition: background-color 0.3s ease;
        }

        /* Dark mode styles */
        body.dark-mode {
            background-color: #1a1a1a;
            color: #ffffff;
        }

        .dark-mode .card {
            background-color: #2d2d2d;
            border-color: #404040;
        }

        .dark-mode .table {
            color: #ffffff !important;
            background-color: #1a1a1a !important;
        }


        .dark-mode .table thead {
            background-color: #1a1a1a !important;
        }

        .dark-mode .table tbody tr {
            background-color: #1a1a1a !important;
            color: #ffffff !important;
        }

        .dark-mode .table-hover tbody tr:hover {
            background-color: #2d2d2d !important;
            color: #ffffff !important;
        }

        .dark-mode .table thead tr {
            background-color: #2d2d2d !important;
        }

        .dark-mode .table tbody tr {
            border-color: #404040 !important;
            /* Dark border for table rows */
        }

        .dark-mode .table td,
        .dark-mode .table th {
            color: #ffffff !important;
            border-color: #404040 !important;
            background-color: inherit !important;
        }

        .dark-mode .nav-tabs .nav-link {
            color: #ffffff;
        }

        .dark-mode .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: #2d2d2d;
            border-color: #404040;
        }

        .dark-mode .modal-content {
            background-color: #2d2d2d;
            color: #ffffff;
        }

        .dark-mode .form-control,
        .dark-mode .form-select {
            background-color: #3d3d3d;
            border-color: #404040;
            color: #ffffff;
        }

        .dark-mode .form-control:focus,
        .dark-mode .form-select:focus {
            background-color: #3d3d3d;
            border-color: #0d6efd;
            color: #ffffff;
        }

        .dark-mode .card-title {
            color: #ffffff;
        }

        .dark-mode .btn-warning {
            color: #000000 !important;
        }

        .dark-mode .btn-danger {
            color: #ffffff !important;
        }

        .dark-mode .table-responsive {
            background-color: #1a1a1a !important;
        }

        .dark-mode .card-body {
            background-color: #1a1a1a !important;
        }

        .dark-mode .page-link {
            background-color: #2d2d2d;
            border-color: #404040;
            color: #ffffff;
        }

        .dark-mode .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .dark-mode .page-item.disabled .page-link {
            background-color: #1a1a1a;
            border-color: #404040;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa"
                            type="button" role="tab">Data Siswa</button>
                    </li>
                </ul>
                <!-- Add this dark mode toggle button -->
                <button class="btn btn-outline-primary" id="darkModeToggle">
                    <i class="bi bi-moon-fill" id="darkModeIcon"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <!-- Siswa Tab -->
                    <div class="tab-pane fade show active" id="siswa" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <img src="OIIANormal.webp" width="50px" height="50px" alt="Logo" class="me-2">
                            <h5 class="card-title">Data Siswa</h5>
                            <a href="frmsiswa.php" class="btn btn-primary">Tambah Siswa</a>
                            <!-- Changed from button to anchor -->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "koneksi.php";

                                    // Number of records per page
                                    $records_per_page = 6;

                                    // Get current page
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    $offset = ($current_page - 1) * $records_per_page;

                                    // Get total number of records
                                    $total_query = "SELECT COUNT(*) as total FROM siswa";
                                    $total_result = mysqli_query($koneksi, $total_query);
                                    $total_row = mysqli_fetch_assoc($total_result);
                                    $total_records = $total_row['total'];

                                    // Calculate total pages
                                    $total_pages = ceil($total_records / $records_per_page);

                                    // Get records for current page
                                    $query = "SELECT * FROM siswa LIMIT $offset, $records_per_page";
                                    $result = mysqli_query($koneksi, $query);
                                    $no = $offset + 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nis']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nama_siswa']) . "</td>";
                                        echo "<td>" . ($row['jk'] == 'L' ? 'Laki-laki' : 'Perempuan') . "</td>";
                                        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['telepon']) . "</td>";
                                        echo "<td>
                                                <button class='btn btn-warning btn-sm' onclick='editSiswa(\"" . $row['nis'] . "\")'>Edit</button>
                                                <button class='btn btn-danger btn-sm' onclick='deleteSiswa(\"" . $row['nis'] . "\")'>Delete</button>
                                              </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation" class="mt-4">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li
                                        class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <!-- Modal Form Siswa -->
                    <div class="modal fade" id="formSiswaModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="formSiswa" action="proses.php" method="post" class="needs-validation"
                                        novalidate>
                                        <div class="mb-3">
                                            <label for="nis" class="form-label">NIS</label>
                                            <input type="text" class="form-control" id="nis" name="nis" required>
                                            <div class="invalid-feedback">NIS tidak boleh kosong</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                            <div class="invalid-feedback">Nama tidak boleh kosong</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jk" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" id="jk" name="jk" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            <div class="invalid-feedback">Pilih jenis kelamin</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                                required></textarea>
                                            <div class="invalid-feedback">Alamat tidak boleh kosong</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telepon" class="form-label">Telepon</label>
                                            <input type="text" class="form-control" id="telepon" name="telepon"
                                                required>
                                            <div class="invalid-feedback">Telepon tidak boleh kosong</div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formSiswa" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="js/bootstrap.bundle.min.js"></script>
                    <script>
                        // Form validation
                        (function () {
                            'use strict'
                            var forms = document.querySelectorAll('.needs-validation')
                            Array.prototype.slice.call(forms)
                                .forEach(function (form) {
                                    form.addEventListener('submit', function (event) {
                                        if (!form.checkValidity()) {
                                            event.preventDefault()
                                            event.stopPropagation()
                                        }
                                        form.classList.add('was-validated')
                                    }, false)
                                })
                        })()

                        // Delete functions
                        function deleteUser(id) {
                            if (confirm('Are you sure you want to delete this user?')) {
                                fetch('delete_user.php?id=' + id)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            location.reload();
                                        } else {
                                            alert('Error deleting user');
                                        }
                                    });
                            }
                        }

                        function deleteSiswa(nis) {
                            if (confirm('Are you sure you want to delete this student?')) {
                                fetch('delete_siswa.php?nis=' + nis)
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            location.reload();
                                        } else {
                                            alert('Error deleting student');
                                        }
                                    });
                            }
                        }

                        // URL parameter handling for active tab
                        document.addEventListener('DOMContentLoaded', function () {
                            const urlParams = new URLSearchParams(window.location.search);
                            const activeTab = urlParams.get('tab');
                            if (activeTab) {
                                const tab = new bootstrap.Tab(document.querySelector(`#${activeTab}-tab`));
                                tab.show();
                            }
                        });

                        // Add this function to your existing JavaScript
                        function editUser(id, username, role) {
                            // Get the modal elements
                            const modal = document.getElementById('formUserModal');
                            const form = document.getElementById('formUser');

                            // Set the form values
                            document.getElementById('username').value = username;
                            document.getElementById('role').value = role;

                            // Add hidden input for ID
                            let hiddenId = document.getElementById('userId');
                            if (!hiddenId) {
                                hiddenId = document.createElement('input');
                                hiddenId.type = 'hidden';
                                hiddenId.id = 'userId';
                                hiddenId.name = 'id';
                                form.appendChild(hiddenId);
                            }
                            hiddenId.value = id;

                            // Clear password field and make it optional for editing
                            const passwordField = document.getElementById('password');
                            passwordField.value = '';
                            passwordField.required = false;

                            // Change form action for edit
                            form.action = 'edit_user.php';

                            // Show the modal
                            const modalInstance = new bootstrap.Modal(modal);
                            modalInstance.show();
                        }

                        // Replace the existing editSiswa function with this:
                        function editSiswa(nis) {
                            window.location.href = `frmedit.php?nis=${nis}`;
                        }

                        // Dark mode functionality
                        document.addEventListener('DOMContentLoaded', function () {
                            const darkModeToggle = document.getElementById('darkModeToggle');
                            const darkModeIcon = document.getElementById('darkModeIcon');

                            // Check for saved dark mode preference
                            const darkMode = localStorage.getItem('darkMode') === 'enabled';
                            if (darkMode) {
                                document.body.classList.add('dark-mode');
                                darkModeIcon.classList.remove('bi-moon-fill');
                                darkModeIcon.classList.add('bi-sun-fill');
                            }

                            // Toggle dark mode
                            darkModeToggle.addEventListener('click', () => {
                                document.body.classList.toggle('dark-mode');

                                // Force table redraw
                                const table = document.querySelector('.table');
                                if (table) {
                                    table.style.display = 'none';
                                    setTimeout(() => {
                                        table.style.display = '';
                                    }, 0);
                                }

                                // Update icon
                                if (document.body.classList.contains('dark-mode')) {
                                    darkModeIcon.classList.remove('bi-moon-fill');
                                    darkModeIcon.classList.add('bi-sun-fill');
                                    localStorage.setItem('darkMode', 'enabled');
                                } else {
                                    darkModeIcon.classList.remove('bi-sun-fill');
                                    darkModeIcon.classList.add('bi-moon-fill');
                                    localStorage.setItem('darkMode', null);
                                }
                            });
                        });
                    </script>
</body>

</html>