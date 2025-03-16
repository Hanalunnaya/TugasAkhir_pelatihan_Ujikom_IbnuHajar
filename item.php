<?php
require_once 'connection.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM item ORDER BY id_item ASC";
$result = mysqli_query($conn, $query);
if ($result) {
    $item = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $item = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'include/head.php'; ?>
    <title>Item</title>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include_once 'include/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once 'include/topbar.php'; ?>
                <div class="container-fluid">
                    <div class="d-sm-flex align-item-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Item</h1>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <a href="tambah_item.php" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Item</a>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="150" class="text-center">No.</th>
                                                    <th class="text-center">Nama Item</th>
                                                    <th class="text-center">UOM</th>
                                                    <th class="text-center">Harga Beli</th>
                                                    <th class="text-center">Harga Jual</th>
                                                    <?php if ($dataUser['jabatan'] == 'Admin'): ?>
                                                        <th width="250" class="text-center">Aksi</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php if (!empty($item)): ?>
                                                    <?php foreach ($item as $item): ?>
                                                        <tr>
                                                            <td class="text-center"><?= $i++; ?>.</td>
                                                            <td class="text-center"><?= $item['nama_item']; ?></td>
                                                            <td class="text-center"><?= $item['uom']; ?></td>
                                                            <td class="text-center"><?= $item['harga_beli']; ?></td>
                                                            <td class="text-center"><?= $item['harga_jual']; ?></td>
                                                            <?php if ($dataUser['jabatan'] == 'Admin'): ?>
                                                                <td class="text-center">
                                                                    <a href="ubah_item.php?id_item=<?= $item['id_item']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                                    <a href="hapus_item.php?id_item=<?= $item['id_item']; ?>" class="btn btn-danger btn-delete" data-nama_item="<?= $item['nama_item']; ?>">
                                                                        <i class="fas fa-fw fa-trash"></i> Hapus
                                                                    </a>
                                                                </td>
                                                            <?php endif ?>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Tidak ada data item.</td>
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
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SPK SAW Tahfizh 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php include_once 'include/script.php'; ?>
</body>
</html>