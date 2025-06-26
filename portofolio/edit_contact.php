<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "portofolio";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM kontak WHERE id=$id");
    header("Location: edit_contact.php");
    exit;
}

$sql = "SELECT * FROM kontak ORDER BY waktu DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kontak - El-Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        body {
            margin: 0;
            background: linear-gradient(to right, #dff1ff, #b6dfff);
            padding: 40px 20px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: rgba(255, 255, 255, 0.65);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            backdrop-filter: blur(10px);
        }
        h1 {
            text-align: center;
            color: #468EAC;
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 28px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            overflow: hidden;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }
        th {
            background-color: #468EAC;
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f7fafd;
        }
        .back {
            display: inline-block;
            background: linear-gradient(90deg, #468EAC, #6bd4e3);
            color: #fff;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s ease;
            box-shadow: 0 2px 6px rgba(70, 142, 172, 0.15);
        }
        .back:hover {
            background: linear-gradient(90deg, #6bd4e3, #468EAC);
        }
        .delete-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: background 0.2s ease;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                font-size: 13px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
    <script>
        function confirmDelete(nama, url) {
            if (confirm('Hapus kontak atas nama "' + nama + '"?')) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Data Kontak Masuk</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>WhatsApp</th>
                    <th>Jasa</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['whatsapp']) ?></td>
                        <td><?= htmlspecialchars($row['jasa']) ?></td>
                        <td><?= htmlspecialchars($row['waktu']) ?></td>
                        <td>
                            <button class="delete-btn" onclick="confirmDelete('<?= htmlspecialchars($row['nama']) ?>', 'edit_contact.php?delete=<?= $row['id'] ?>')">Hapus</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">Belum ada data masuk</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="admin.php" class="back">← Kembali ke Admin</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
