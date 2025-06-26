<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data gambar terlebih dahulu untuk dihapus dari folder
    $get_image = $conn->prepare("SELECT image_path FROM gallery WHERE id = ?");
    $get_image->bind_param("i", $id);
    $get_image->execute();
    $get_image->bind_result($image_path);
    $get_image->fetch();
    $get_image->close();

    // Hapus file gambar dari folder (jika ada)
    if ($image_path && file_exists($image_path)) {
        unlink($image_path);
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: edit_gallery.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
