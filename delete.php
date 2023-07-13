<?php
include 'koneksi.php'; 


if (!isset($_GET['judul'])) {
    header('Location: index.php');
    exit();
}

$judul = $_GET['judul'];


$query = "DELETE FROM kursus WHERE judul = '$judul'";
$result = mysqli_query($conn, $query);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data: " . mysqli_error($conn);
}
?>
