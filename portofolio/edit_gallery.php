<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM gallery ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Galeri - El-Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; font-family: 'Montserrat', sans-serif; }
        body {
            margin: 0;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: rgba(255,255,255,0.65);
            padding: 38px 24px;
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(70,142,172,0.13), 0 2px 8px rgba(70,142,172,0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h1 {
            text-align: center;
            color: #468EAC;
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 32px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.9);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(70,142,172,0.05);
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e0eafc;
            font-size: 0.95rem;
        }
        th {
            background: linear-gradient(90deg, #468EAC 60%, #74ebd5 100%);
            color: white;
            font-weight: 600;
        }
        img {
            max-height: 60px;
            border-radius: 8px;
        }
        .btn {
            padding: 6px 14px;
            margin: 2px 0;
            text-decoration: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-edit {
            background: #f0ad4e;
            color: white;
        }
        .btn-delete {
            background: #d9534f;
            color: white;
        }
        .btn-edit:hover { background: #ec971f; transform: translateY(-2px); }
        .btn-delete:hover { background: #c9302c; transform: translateY(-2px); }

        .btn-add {
            background: linear-gradient(90deg, #5cb85c 60%, #74ebd5 100%);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 24px;
            transition: all 0.2s;
        }
        .btn-add:hover {
            background: linear-gradient(90deg, #74ebd5 60%, #5cb85c 100%);
            transform: scale(1.03);
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
            transform: translateY(-2px);
        }
        td a {
            color: #468EAC;
            text-decoration: underline;
        }
        @media (max-width: 700px) {
            .container { padding: 20px 12px; }
            table, thead, tbody, th, td, tr { font-size: 0.9rem; }
            h1 { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Panel Admin Galeri</h1>
        <a href="add.php" class="btn-add">+ Tambah Karya Baru</a>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['title']); ?></td>
                    <td><img src="<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['title']); ?>"></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td><a href="<?= htmlspecialchars($row['link']); ?>" target="_blank">Lihat</a></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a><br>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin.php" class="back-btn">Kembali ke Admin</a>
    </div>
</body>
</html>
