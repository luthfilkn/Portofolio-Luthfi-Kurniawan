<?php
include 'koneksi.php';

// Fungsi upload gambar
function upload_gambar($input_name) {
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] == 0) {
        $target_dir = "assets/";
        $filename = time() . '_' . basename($_FILES[$input_name]['name']);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $target_file)) {
                return $target_file;
            }
        }
    }
    return null;
}

// Tambah artikel
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = upload_gambar('gambar');
    if ($gambar) {
        mysqli_query($conn, "INSERT INTO artikel (judul, gambar, isi) VALUES ('$judul', '$gambar', '$isi')");
    }
}

// Hapus artikel
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    // Hapus file gambar dari server
    $res = mysqli_query($conn, "SELECT gambar FROM artikel WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if ($row && file_exists($row['gambar'])) unlink($row['gambar']);
    mysqli_query($conn, "DELETE FROM artikel WHERE id=$id");
    header("Location: edit_article.php");
    exit;
}

// Ambil data artikel
$artikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id ASC");

// Ambil data untuk edit jika ada
$edit_data = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_result = mysqli_query($conn, "SELECT * FROM artikel WHERE id=$edit_id");
    $edit_data = mysqli_fetch_assoc($edit_result);
}

// Proses update artikel
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $gambar = upload_gambar('gambar');
    if ($gambar) {
        // Hapus gambar lama
        $res = mysqli_query($conn, "SELECT gambar FROM artikel WHERE id=$id");
        $row = mysqli_fetch_assoc($res);
        if ($row && file_exists($row['gambar'])) unlink($row['gambar']);
        mysqli_query($conn, "UPDATE artikel SET judul='$judul', gambar='$gambar', isi='$isi' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE artikel SET judul='$judul', isi='$isi' WHERE id=$id");
    }
    header("Location: edit_article.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
<style>
    * {
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        margin: 0;
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        background: rgba(255,255,255,0.65);
        padding: 38px 24px;
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(70,142,172,0.13), 0 2px 8px rgba(70,142,172,0.08);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    h2 {
        color: #468EAC;
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }

    input, textarea {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 16px;
        border: 1.5px solid #e0eafc;
        border-radius: 8px;
        font-size: 1rem;
        background: #fafdff;
        transition: border 0.18s, box-shadow 0.18s;
    }

    input:focus, textarea:focus {
        border-color: #468EAC;
        box-shadow: 0 2px 8px rgba(70,142,172,0.10);
        outline: none;
    }

    button, .edit-btn, .hapus-btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    button {
        background: linear-gradient(90deg, #468EAC 60%, #74ebd5 100%);
        color: #fff;
        margin-top: 10px;
    }

    button:hover {
        background: linear-gradient(90deg, #74ebd5 60%, #468EAC 100%);
        transform: translateY(-2px) scale(1.03);
    }

    .edit-btn {
        background: #468EAC;
        color: white;
        margin-right: 10px;
    }

    .hapus-btn {
        background: #e74c3c;
        color: white;
    }

    .edit-btn:hover {
        background: #356b80;
    }

    .hapus-btn:hover {
        background: #c0392b;
    }

    .back-btn {
        display: inline-block;
        margin-top: 32px;
        background: #468EAC;
        color: #fff;
        padding: 10px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 700;
        transition: background 0.2s, transform 0.18s;
        box-shadow: 0 2px 8px rgba(70,142,172,0.10);
    }

    .back-btn:hover {
        background: #356b80;
        transform: translateY(-2px) scale(1.03);
    }

    .article-item {
        background: #fff;
        padding: 16px;
        border-radius: 14px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(70,142,172,0.06);
    }

    .article-item img {
        border-radius: 8px;
        margin: 12px 0;
        width: 100%;
        max-width: 200px;
    }
</style>

</head>
<body>
    <div class="container">
        <?php if ($edit_data): ?>
            <h2 class="form-title">Edit Artikel</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                <input type="text" name="judul" value="<?php echo htmlspecialchars($edit_data['judul']); ?>" placeholder="Judul Artikel" required>
                <input type="file" name="gambar" accept="image/*">
                <?php if ($edit_data['gambar']): ?>
                    <div><img src="<?php echo htmlspecialchars($edit_data['gambar']); ?>" alt="" style="width:120px;border-radius:6px;margin:8px 0;"></div>
                <?php endif; ?>
                <textarea name="isi" rows="5" required><?php echo htmlspecialchars($edit_data['isi']); ?></textarea>
                <button type="submit" name="update">Update Artikel</button>
                <a href="edit_article.php" style="margin-left:12px;color:#468EAC;">Batal</a>
            </form>
        <?php else: ?>
            <h2 class="form-title">Tambah Artikel Baru</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="judul" placeholder="Judul Artikel" required>
                <input type="file" name="gambar" accept="image/*" required>
                <textarea name="isi" placeholder="Isi Artikel" rows="5" required></textarea>
                <button type="submit" name="tambah">Tambah Artikel</button>
            </form>
        <?php endif; ?>

        <h2>Daftar Artikel</h2>
        <ul class="article-list">
            <?php
            $artikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id ASC");
            while($row = mysqli_fetch_assoc($artikel)): ?>
            <li class="article-item">
                <strong><?php echo htmlspecialchars($row['judul']); ?></strong><br>
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="" style="width:120px;border-radius:6px;margin:8px 0;">
                <div style="margin:8px 0;"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></div>
                <a href="?edit=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                <a href="?hapus=<?php echo $row['id']; ?>" class="hapus-btn" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
            </li>
            <?php endwhile; ?>
        </ul>
        <a href="admin.php" class="back-btn">Kembali ke Admin</a>
    </div>
</body>
</html>