<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan.";
    exit();
}

$id = $_GET['id'];

// Ambil data lama
$stmt = $conn->prepare("SELECT title, description, image_path, link FROM gallery WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $description, $image_path, $link);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = $_POST['title'];
    $newDescription = $_POST['description'];
    $newLink = $_POST['link'];
    $newImagePath = $image_path;

    // Cek apakah gambar baru diunggah
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "assets/";
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . time() . "_" . $image_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($image_file_type, $allowed_types) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Hapus gambar lama jika ada
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $newImagePath = $target_file;
        }
    }

    // Update ke database
    $update = $conn->prepare("UPDATE gallery SET title = ?, description = ?, image_path = ?, link = ? WHERE id = ?");
    $update->bind_param("ssssi", $newTitle, $newDescription, $newImagePath, $newLink, $id);
    if ($update->execute()) {
        header("Location: edit_gallery.php");
        exit();
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karya</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body {
            margin: 0;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        }
        .container {
            max-width: 650px;
            margin: 50px auto;
            background: rgba(255,255,255,0.65);
            padding: 38px 28px;
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(70,142,172,0.13), 0 2px 8px rgba(70,142,172,0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h2 {
            text-align: center;
            color: #468EAC;
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 28px;
        }
        label {
            display: block;
            margin-top: 18px;
            font-weight: 600;
            color: #2b5876;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1.5px solid #e0eafc;
            font-size: 1rem;
            background: #fafdff;
            transition: border 0.18s, box-shadow 0.18s;
        }
        input:focus, textarea:focus {
            border: 1.5px solid #468EAC;
            outline: none;
            box-shadow: 0 2px 8px rgba(70,142,172,0.10);
        }
        img {
            max-height: 160px;
            display: block;
            margin-top: 14px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        button {
            margin-top: 24px;
            background: linear-gradient(90deg, #468EAC 60%, #74ebd5 100%);
            color: #fff;
            border: none;
            padding: 12px 28px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
            box-shadow: 0 2px 8px rgba(70,142,172,0.10);
        }
        button:hover {
            background: linear-gradient(90deg, #74ebd5 60%, #468EAC 100%);
            transform: translateY(-2px);
        }
        .back-link {
            display: inline-block;
            margin-top: 28px;
            color: #468EAC;
            text-decoration: none;
            font-weight: 600;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        @media (max-width: 700px) {
            .container { padding: 20px 18px; }
            h2 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Karya</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($title); ?>" required>

            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($description); ?></textarea>

            <label for="link">Link Karya</label>
            <input type="text" name="link" id="link" value="<?= htmlspecialchars($link); ?>" required>

            <label for="image">Gambar Baru (kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="image" id="image" accept="image/*">
            <img src="<?= htmlspecialchars($image_path); ?>" alt="Gambar Lama">

            <button type="submit" name="submit">Simpan Perubahan</button>
        </form>
        <a href="edit_gallery.php" class="back-link">← Kembali ke Admin Galeri</a>
    </div>
</body>
</html>
