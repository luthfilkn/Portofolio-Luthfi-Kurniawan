<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];

    $target_dir = "assets/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            echo "File bukan gambar.";
            $upload_ok = 0;
        }
    }

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($image_file_type, $allowed_types)) {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
        $upload_ok = 0;
    }

    if ($upload_ok && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO gallery (title, description, image_path, link) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $target_file, $link);
        if ($stmt->execute()) {
            header("Location: edit_gallery.php");
            exit();
        } else {
            echo "Gagal menyimpan data ke database.";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karya Baru</title>
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
        <h2>Tambah Karya Baru</h2>
        <form action="add.php" method="post" enctype="multipart/form-data">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <label for="link">Link Karya</label>
            <input type="text" name="link" id="link" required>

            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <button type="submit" name="submit">Simpan</button>
        </form>
        <a href="edit_gallery.php" class="back-link">← Kembali ke Admin Galeri</a>
    </div>
</body>
</html>
