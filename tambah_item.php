<?php
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['btnTambahItem'])) {
    // Debugging: Check if $_POST array contains the expected data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (isset($_POST['nama_item'])) {
        $nama_item = htmlspecialchars($_POST['nama_item']);
        $uom = htmlspecialchars($_POST['uom']);
        $harga_beli = htmlspecialchars($_POST['harga_beli']);
        $harga_jual = htmlspecialchars($_POST['harga_jual']);

        $insert_item = mysqli_query($conn, "INSERT INTO item (nama_item, uom, harga_beli, harga_jual) VALUES ('$nama_item', '$uom', '$harga_beli', '$harga_jual')");

        if ($insert_item) {
            $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Item $nama_item berhasil ditambahkan!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

            echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Item $nama_item berhasil ditambahkan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'item.php';
                        }
                    });
                </script>
            ";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn); 
            $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Item $nama_item gagal ditambahkan!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");
            echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Item $nama_item gagal ditambahkan!'
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
        echo "Error: 'nama_item' is not set in the form submission.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'include/head.php'; ?>
    <title>Tambah Item</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Item</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="nama_item">Nama Item</label>
                                            <input type="text" class="form-control" id="nama_item" name="nama_item" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uom">Unit of Measure (UOM)</label>
                                            <input type="text" class="form-control" id="uom" name="uom" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                                        </div>
                                        <button type="submit" name="btnTambahItem" class="btn btn-primary">Tambah Item</button>
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