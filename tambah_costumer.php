<?php
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['btnTambahCostumer'])) {
    // Debugging: Check if $_POST array contains the expected data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (isset($_POST['nama_costumer'])) {
        $nama_costumer = htmlspecialchars($_POST['nama_costumer']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $telp = htmlspecialchars($_POST['telp']);
        $fax = htmlspecialchars($_POST['fax']);
        $email = htmlspecialchars($_POST['email']);

        $insert_costumer = mysqli_query($conn, "INSERT INTO costumer (nama_costumer, alamat, telp, fax, email) VALUES ('$nama_costumer', '$alamat', '$telp', '$fax', '$email')");

        if ($insert_costumer) {
            $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Customer $nama_costumer berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Customer $nama_costumer berhasil ditambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'costumer.php';
                        }
                    });
                </script>
            ";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn); 
            $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Customer $nama_costumer gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");
            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Customer $nama_costumer gagal ditambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.history.back();
                        }
                    });
                </script>
            ";
            exit;
        }
    } else {
        echo "Error: 'nama_costumer' is not set in the form submission.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'include/head.php'; ?>
    <title>Tambah Customer</title>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include_once 'include/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include_once 'include/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Customer</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="nama_costumer">Nama Customer</label>
                                            <input type="text" class="form-control" id="nama_costumer" name="nama_costumer" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">Telepon</label>
                                            <input type="text" class="form-control" id="telp" name="telp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <button type="submit" name="btnTambahCostumer" class="btn btn-primary">Tambah Customer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SPK SAW Tahfizh 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once 'include/script.php'; ?>
</body>
</html>