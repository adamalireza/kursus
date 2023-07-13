<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];

    $query = "INSERT INTO kursus (judul, deskripsi, durasi) VALUES ('$judul', '$deskripsi', '$durasi')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM kursus";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD Sederhana</title>
</head>
<body>
    <div class="container">
        <h1>Data Tabel Kursus</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah Data
        </button>

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kursus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul:</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi:</label>
                                <input type="text" class="form-control" id="durasi" name="durasi" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Durasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['deskripsi']; ?></td>
                        <td><?php echo $row['durasi']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $row['judul']; ?>">
                                Edit
                            </button>
                            <a href="delete.php?judul=<?php echo $row['judul']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal-<?php echo $row['judul']; ?>" tabindex="-1" aria-labelledby="editModalLabel-<?php echo $row['judul']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel-<?php echo $row['judul']; ?>">Edit Data Kursus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="">
                                        <div class="mb-3">
                                            <label for="edit-judul" class="form-label">Judul:</label>
                                            <input type="text" class="form-control" id="edit-judul" name="judul" value="<?php echo $row['judul']; ?>" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-deskripsi" class="form-label">Deskripsi:</label>
                                            <textarea class="form-control" id="edit-deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-durasi" class="form-label">Durasi:</label>
                                            <input type="text" class="form-control" id="edit-durasi" name="durasi" value="<?php echo $row['durasi']; ?>" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
