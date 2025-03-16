<?php
session_start();
require 'connection.php';
include_once 'include/head.php';
include_once 'include/script.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}


$id_item = $_GET['id_item'];

$data_item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM item WHERE id_item = '$id_item'"));
if (!$data_item) {

    header("Location: item.php");
    exit;
}

$nama_item = $data_item['nama_item']; 


$delete_item = mysqli_query($conn, "DELETE FROM item WHERE id_item = '$id_item'");

if ($delete_item) {

    $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Item $nama_item berhasil dihapus!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Item $nama_item berhasil dihapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'items.php';
                }
            });
        </script>
    ";
    exit;
} else {

    $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Item $nama_item gagal dihapus!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Item $nama_item gagal dihapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'item.php';
                }
            });
        </script>
    ";
    exit;
}
?>