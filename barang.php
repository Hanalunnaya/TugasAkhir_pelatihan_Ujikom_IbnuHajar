<?php
session_start(); // Pastikan session_start() ada di awal script
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID item dari parameter URL
if (!isset($_GET['id_item'])) {
    header("Location: item.php");
    exit;
}

$id_item = $_GET['id_item'];

// Ambil data item dari database berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM item WHERE id_item = ?");
$stmt->bind_param("i", $id_item);
$stmt->execute();
$result = $stmt->get_result();
$data_item = $result->fetch_assoc();

// Jika data tidak ditemukan, redirect ke halaman item.php
if (!$data_item) {
    header("Location: item.php");
    exit;
}

// Proses form ubah data
if (isset($_POST['btnUbahItem'])) {
    $nama_item = htmlspecialchars($_POST['nama_item']);
    $uom = htmlspecialchars($_POST['uom']);
    $harga_beli = htmlspecialchars($_POST['harga_beli']);
    $harga_jual = htmlspecialchars($_POST['harga_jual']);

    // Query untuk update data item
    $stmt = $conn->prepare("UPDATE item SET nama_item = ?, uom = ?, harga_beli = ?, harga_jual = ? WHERE id_item = ?");
    $stmt->bind_param("ssddi", $nama_item, $uom, $harga_beli, $harga_jual, $id_item);

    if ($stmt->execute()) {
        // Log berhasil
        $log_message = "Item $nama_item berhasil diubah!";
        $log_stmt = $conn->prepare("INSERT INTO log (action, timestamp, id_user) VALUES (?, CURRENT_TIMESTAMP(), ?)");
        $log_stmt->bind_param("si", $log_message, $_SESSION['id_user']);
        $log_stmt->execute();

        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Item $nama_item berhasil diubah!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'item.php';
                    }
                });
            </script>
        ";
        exit;
    } else {
        // Log gagal
        $log_message = "Item $nama_item gagal diubah!";
        $log_stmt = $conn->prepare("INSERT INTO log (action, timestamp, id_user) VALUES (?, CURRENT_TIMESTAMP(), ?)");
        $log_stmt->bind_param("si", $log_message, $_SESSION['id_user']);
        $log_stmt->execute();

        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Item $nama_item gagal diubah!'
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
    <title>Ubah Item - <?= htmlspecialchars($data_item['nama_item']); ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">Ubah Item</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="nama_item">Nama Item</label>
                                            <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?= htmlspecialchars($data_item['nama_item']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="uom">Unit of Measure (UOM)</label>
                                            <input type="text" class="form-control" id="uom" name="uom" value="<?= htmlspecialchars($data_item['uom']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?= htmlspecialchars($data_item['harga_beli']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?= htmlspecialchars($data_item['harga_jual']); ?>" required>
                                        </div>
                                        <button type="submit" name="btnUbahItem" class="btn btn-primary">Ubah Item</button>
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