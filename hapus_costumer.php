<?php

require 'connection.php';
include_once 'include/head.php';
include_once 'include/script.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_costumer = $_GET['id_costumer'];

$data_costumer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM costumer WHERE id_costumer = '$id_costumer'"));
if (!$data_costumer) {

    header("Location: costumer.php");
    exit;
}

$nama_costumer = $data_costumer['nama_costumer']; 


$delete_costumer = mysqli_query($conn, "DELETE FROM costumer WHERE id_costumer = '$id_costumer'");

if ($delete_costumer) {
    $log_berhasil = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Costumer $nama_costumer berhasil dihapus!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

    echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Costumer $nama_costumer berhasil dihapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'costumer.php';
                }
            });
        </script>
    ";
    exit;
} else {
    $log_gagal = mysqli_query($conn, "INSERT INTO log VALUES ('', 'Costumer $nama_costumer gagal dihapus!', CURRENT_TIMESTAMP(), " . $_SESSION['id_user'] . ")");

    echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Costumer $nama_costumer gagal dihapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'costumer.php';
                }
            });
        </script>
    ";
    exit;
}
?>