<?php
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM costumer ORDER BY id_costumer ASC";
$result = mysqli_query($conn, $query);
if ($result) {
    $costumer = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $costumer = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once 'include/head.php'; ?>

    <title>Costumer</title>

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
                        <h1 class="h3 mb-0 text-gray-800">Costumer</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <a href="tambah_costumer.php" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Costumer</a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="150" class="text-center">No.</th>
                                                    <th class="text-center">Nama Costumer</th>
                                                    <th class="text-center">Alamat</th>
                                                    <th class="text-center">Telpon</th>
                                                    <th class="text-center">Fax</th>
                                                    <th class="text-center">Email</th>
                                                    <?php if ($dataUser['jabatan'] == 'Admin'): ?>
                                                        <th width="250" class="text-center">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php if (!empty($costumer)): ?>
                                                    <?php foreach ($costumer as $dk): ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++; ?>.</td>
                                                            <td class="text-center"><?= $dk['nama_costumer']; ?></td>
                                                            <td class="text-center"><?= $dk['alamat']; ?></td>
                                                            <td class="text-center"><?= $dk['telp']; ?></td>
                                                            <td class="text-center"><?= $dk['fax']; ?></td>
                                                            <td class="text-center"><?= $dk['email']; ?></td>
                                                            <?php if ($dataUser['jabatan'] == 'Admin'): ?>
                                                                <td class="text-center">
                                                                    <a href="ubah_costumer.php?id_costumer=<?= $dk['id_costumer']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                                    <a href="hapus_costumer.php?id_costumer=<?= $dk['id_costumer']; ?>" class="btn btn-danger btn-delete" data-nama_costumer="<?= $dk['nama_costumer']; ?>">
                                                                        <i class="fas fa-fw fa-trash"></i> Hapus
                                                                    </a>
                                                                </td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center">Tidak ada data costumer.</td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
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