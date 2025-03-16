<?php
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_costumer = $_GET['id_costumer'];

$costumer = mysqli_query($conn, "SELECT * FROM costumer WHERE id_costumer = '$id_costumer'");
$data_costumer = mysqli_fetch_assoc($costumer);


if (!$data_costumer) {
    header("Location: costumer.php");
    exit;
}


// Proses form ubah data
if (isset($_POST['btnUbahCostumer'])) {

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $nama_costumer = htmlspecialchars($_POST['nama_costumer']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $telp = htmlspecialchars($_POST['telp']);
    $fax = htmlspecialchars($_POST['fax']);
    $email = htmlspecialchars($_POST['email']);

    // Query untuk update data costumer
    $update_costumer = mysqli_query($conn, "UPDATE costumer SET 
        nama_costumer = '$nama_costumer', 
        alamat = '$alamat', 
        telp = '$telp', 
        fax = '$fax', 
        email = '$email' 
        WHERE id_costumer = '$id_costumer'");

    if ($update_costumer) {
        // Log berhasil
        $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Customer $nama_costumer berhasil diubah!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Customer $nama_costumer berhasil diubah!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'costumer.php';
                    }
                });
            </script>
        ";
        exit;
    } else {
        // Log gagal
        $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Customer $nama_costumer gagal diubah!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Customer $nama_costumer gagal diubah!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
            </script>
        ";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'include/head.php'; ?>
    <title>Ubah Customer - <?= $data_costumer['nama_costumer']; ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">Ubah Customer</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="nama_costumer">Nama Customer</label>
                                            <input type="text" class="form-control" id="nama_costumer" name="nama_costumer" value="<?= $data_costumer['nama_costumer']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data_costumer['alamat']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telp">Telepon</label>
                                            <input type="text" class="form-control" id="telp" name="telp" value="<?= $data_costumer['telp']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fax">Fax</label>
                                            <input type="text" class="form-control" id="fax" name="fax" value="<?= $data_costumer['fax']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?= $data_costumer['email']; ?>" required>
                                        </div>
                                        <button type="submit" name="btnUbahCostumer" class="btn btn-primary">Ubah Customer</button>
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