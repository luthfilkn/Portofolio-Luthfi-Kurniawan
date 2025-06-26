<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Selamat Datang</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #74ebd5 0%, #ACB6E5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .glass-card {
            background: rgba(255,255,255,0.18);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 24px;
            border: 1.5px solid rgba(255,255,255,0.28);
            padding: 36px 28px 28px 28px;
            max-width: 370px;
            width: 94vw;
            position: relative;
        }
        .glass-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 90px; height: 90px;
            background: radial-gradient(circle, #74ebd5aa 60%, transparent 100%);
            z-index: 0;
        }
        .glass-card::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 90px; height: 90px;
            background: radial-gradient(circle, #ACB6E5aa 60%, transparent 100%);
            z-index: 0;
        }
        h2 {
            color: #2b5876;
            text-align: center;
            margin-bottom: 10px;
            font-size: 1.6rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }
        .welcome {
            font-size: 0.95rem;
            color: #444;
            margin-bottom: 28px;
            text-align: center;
            z-index: 1;
        }
        .admin-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        .admin-menu li {
            margin-bottom: 18px;
        }
        .admin-link {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.55);
            color: #2b5876;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 1.08rem;
            font-weight: 600;
            box-shadow: 0 2px 12px rgba(44, 62, 80, 0.07);
            transition: background 0.18s, color 0.18s, transform 0.13s, box-shadow 0.18s;
            border: 1px solid #e0eafc;
        }
        .admin-link svg {
            width: 24px;
            height: 24px;
            opacity: 0.85;
        }
        .admin-link:hover {
            background: linear-gradient(90deg, #74ebd5 60%, #ACB6E5 100%);
            color: #fff;
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 4px 18px rgba(44, 62, 80, 0.13);
            border-color: #74ebd5;
        }
        .logout {
            margin-top: 24px;
            font-size: 0.9rem;
            color: #fff;
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .glass-card { padding: 18px 2vw; }
            h2 { font-size: 1.2rem; }
            .admin-link { font-size: 0.97rem; padding: 10px 8px; }
        }
    </style>
</head>
<body>
    <div class="glass-card">
        <h2>Admin Panel</h2>
        <div class="welcome">Selamat Datang, <strong><?php echo $_SESSION['username']; ?></strong>!</div>
        <ul class="admin-menu">
            <li><a class="admin-link" href="index.php">🏠 Landing Page</a></li>
            <li><a class="admin-link" href="edit_portofolio.php">📝 Edit Portofolio</a></li>
            <li><a class="admin-link" href="edit_article.php">📄 Edit Artikel</a></li>
            <li><a class="admin-link" href="edit_gallery.php">🖼️ Edit Galeri</a></li>
            <li><a class="admin-link" href="edit_contact.php">📞 Edit Kontak</a></li>
        </ul>
        <div style="text-align:center;">
            <a class="logout" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
