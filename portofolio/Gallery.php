<?php
include 'koneksi.php';
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}

$landscape = $portrait = $fourfive = [];

while ($row = $result->fetch_assoc()) {
    $imagePath = $row['image_path'];

    // Pastikan file bisa diakses
    if (!file_exists($imagePath)) continue;

    $imgSize = @getimagesize($imagePath);
    if (!$imgSize) continue;

    $width = $imgSize[0];
    $height = $imgSize[1];
    $ratio = $width / $height;

    if (abs($ratio - (16 / 9)) < 0.1) {
        $landscape[] = $row;
    } elseif (abs($ratio - (9 / 16)) < 0.1) {
        $portrait[] = $row;
    } elseif (abs($ratio - (4 / 5)) < 0.1) {
        $fourfive[] = $row;
    } else {
        $landscape[] = $row; // default fallback
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Karya - El-Portfolio</title>
    <style>
        
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0f4f7;
            overflow-x: hidden;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #468EAC;
            margin-bottom: 32px;
        }

        h2 {
            margin-top: 40px;
            color: #444;
            border-left: 4px solid #468EAC;
            padding-left: 12px;
        }

        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
        }

        .gallery-item {
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 300px;
            flex: 1 1 280px;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
        }

        .ratio-landscape img {
            aspect-ratio: 16 / 9;
        }

        .ratio-portrait img {
            aspect-ratio: 9 / 16;
        }

        .ratio-fourfive img {
            aspect-ratio: 4 / 5;
        }

        .gallery-title {
            font-size: 16px;
            font-weight: bold;
            color: #468EAC;
            margin: 12px 0 4px;
        }

        .gallery-desc {
            font-size: 14px;
            color: #555;
            margin: 0 0 12px 0;
            padding: 0 10px;
        }

        .gallery-link {
            background: #468EAC;
            color: white;
            text-decoration: none;
            padding: 6px 18px;
            border-radius: 16px;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 14px;
            transition: background 0.2s ease;
        }

        .gallery-link:hover {
            background: #366c87;
        }

        @media (max-width: 768px) {
            .gallery-item {
                max-width: 100%;
            }
        }
.navbar {
    background: linear-gradient(90deg, #468EAC, #74ebd5);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 10;
}

.navbar-content {
    max-width: 1000px;
    margin: 0 auto;
    padding: 12px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.navbar-title {
    font-size: 24px;
    font-weight: bold;
    color: white;
    letter-spacing: 1px;
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.nav-links {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    margin-top: 8px;
}

.navbar-link {
    color: white;
    text-decoration: none;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 6px;
    transition: background 0.2s, transform 0.2s;
    position: relative;
}

.navbar-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background: white;
    transition: width 0.25s ease-in-out;
}

.navbar-link:hover::after {
    width: 100%;
}

.navbar-link:hover {
    transform: translateY(-1px);
}

@media (max-width: 700px) {
    .navbar-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-links {
        width: 100%;
        justify-content: flex-start;
    }
}
/* Footer Styles */
.footer {
    background: linear-gradient(135deg, #468EAC, #74ebd5);
    color: white;
    margin-top: 60px;
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    transform: translateX(-50%);
    z-index: 1;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 24px 20px 24px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.footer-section {
    display: flex;
    flex-direction: column;
}

.footer-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 12px;
    letter-spacing: 1px;
    background: linear-gradient(45deg, #fff, #e6f3fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.footer-description {
    font-size: 14px;
    line-height: 1.6;
    opacity: 0.9;
    margin-bottom: 0;
}

.footer-heading {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #fff;
    position: relative;
}

.footer-heading::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 30px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
}

.footer-links {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.footer-link {
    color: rgba(255,255,255,0.9);
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
    padding: 4px 0;
    position: relative;
}

.footer-link::before {
    content: '→';
    position: absolute;
    left: -20px;
    opacity: 0;
    transition: all 0.3s ease;
}

.footer-link:hover {
    color: #fff;
    transform: translateX(15px);
    font-weight: 500;
}

.footer-link:hover::before {
    opacity: 1;
    left: -15px;
}

.footer-contact {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.footer-contact p {
    margin: 0;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.9;
}

.icon {
    font-size: 16px;
    width: 20px;
    text-align: center;
}

/* Social Media */
.social-links {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    padding: 8px;
    box-sizing: border-box;
    flex-shrink: 0;
}

.social-icon {
    width: 24px;
    height: 24px;
    object-fit: contain;
    object-position: center;
    transition: all 0.3s ease;
    display: block;
}

.social-link:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.social-link:hover .social-icon {
    transform: scale(1.1);
}

/* Platform-specific hover */
.social-link[title="LinkedIn"]:hover {
    background: rgba(0, 119, 181, 0.3);
}

.social-link[title="GitHub"]:hover {
    background: rgba(51, 51, 51, 0.3);
}

.social-link[title="Instagram"]:hover {
    background: linear-gradient(45deg, rgba(225, 48, 108, 0.3), rgba(255, 204, 0, 0.3));
}

.social-link[title="YouTube"]:hover {
    background: rgba(255, 0, 0, 0.3);
}

.social-link[title="Twitter"]:hover {
    background: rgba(29, 161, 242, 0.3);
}

.social-link[title="WhatsApp"]:hover {
    background: rgba(37, 211, 102, 0.3);
}

/* Footer Bottom */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.2);
    padding: 20px 24px;
    background: rgba(0,0,0,0.1);
}

.footer-bottom-content {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.footer-bottom-content p {
    margin: 4px 0;
    font-size: 14px;
    opacity: 0.8;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: 25px;
        padding: 30px 20px 15px 20px;
    }

    .footer-section {
        text-align: center;
    }

    .footer-heading::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .social-links {
        justify-content: center;
    }

    .footer-bottom-content {
        padding: 0 10px;
    }
}

@media (max-width: 480px) {
    .footer-title {
        font-size: 24px;
    }

    .footer-content {
        padding: 25px 15px 10px 15px;
    }

    .social-link {
        width: 38px;
        height: 38px;
    }

    .social-icon {
        width: 18px;
        height: 18px;
    }
}

    </style>
</head>
<body>
    <nav class="navbar">
    <div class="navbar-content">
        <span class="navbar-title">El-Portfolio</span>
        <div class="nav-links">
            <a href="index.php" class="navbar-link">Beranda</a>
            <a href="Article.php" class="navbar-link">Artikel</a>
            <a href="Gallery.php" class="navbar-link">Galeri</a>
            <a href="Contact.php" class="navbar-link">Kontak</a>
            <a href="admin.php" class="navbar-link">Admin</a>
        </div>
    </div>
</nav>

    <div class="container">
        <h1>Galeri Projek Saya</h1>

        <?php if (!empty($landscape)): ?>
            <h2></h2>
            <div class="gallery-grid">
                <?php foreach ($landscape as $row): ?>
                    <div class="gallery-item ratio-landscape">
                        <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                        <div class="gallery-title"><?= htmlspecialchars($row['title']); ?></div>
                        <p class="gallery-desc"><?= htmlspecialchars($row['description']); ?></p>
                        <a href="<?= htmlspecialchars($row['link']); ?>" class="gallery-link" target="_blank">Lihat Karya</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($portrait)): ?>
            <h2></h2>
            <div class="gallery-grid">
                <?php foreach ($portrait as $row): ?>
                    <div class="gallery-item ratio-portrait">
                        <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                        <div class="gallery-title"><?= htmlspecialchars($row['title']); ?></div>
                        <p class="gallery-desc"><?= htmlspecialchars($row['description']); ?></p>
                        <a href="<?= htmlspecialchars($row['link']); ?>" class="gallery-link" target="_blank">Lihat Karya</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($fourfive)): ?>
            <h2></h2>
            <div class="gallery-grid">
                <?php foreach ($fourfive as $row): ?>
                    <div class="gallery-item ratio-fourfive">
                        <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                        <div class="gallery-title"><?= htmlspecialchars($row['title']); ?></div>
                        <p class="gallery-desc"><?= htmlspecialchars($row['description']); ?></p>
                        <a href="<?= htmlspecialchars($row['link']); ?>" class="gallery-link" target="_blank">Lihat Karya</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-title">El-Portfolio</h3>
                <p class="footer-description">Portfolio profesional yang menampilkan perjalanan karir dan pencapaian saya.</p>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-heading">Navigasi</h4>
                <div class="footer-links">
                    <a href="index.php" class="footer-link">Beranda</a>
                    <a href="Article.php" class="footer-link">Artikel</a>
                    <a href="Gallery.php" class="footer-link">Galeri</a>
                    <a href="Contact.php" class="footer-link">Kontak</a>
                </div>
            </div>
            
            <div class="footer-section">
                <h4 class="footer-heading">Kontak</h4>
                <div class="footer-contact">
                    <p><i class="icon">📧</i> luthfilkn@gmail.com </p>
                    <p><i class="icon">📱</i> +62 895 6294 79009 </p>
                    <p><i class="icon">📍</i> Jl. Batu Kucing No.29 </p>
                </div>
            </div>

            <div class="footer-section">
                <h4 class="footer-heading">Social Media</h4>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/luthfilkn/" class="social-link" title="LinkedIn" target="_blank">
                        <img src="assets/linkedin.png" alt="LinkedIn" class="social-icon">
                    </a>
                    <a href="https://github.com/luthfilkn" class="social-link" title="GitHub" target="_blank">
                        <img src="assets/github.png" alt="GitHub" class="social-icon">
                    </a>
                    <a href="https://instagram.com/luthfilkn" class="social-link" title="Instagram" target="_blank">
                        <img src="assets/ig.png" alt="Instagram" class="social-icon">
                    </a>
                    <a href="https://www.youtube.com/@luthfilkn" class="social-link" title="Facebook" target="_blank">
                        <img src="assets/yt.png" alt="Facebook" class="social-icon">
                    </a>
                </div>
            </div>        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2025 El-Portfolio. All rights reserved.</p>
                <p>Made with ❤️ by Luthfi Kurniawan</p>
            </div>
        </div>
    </footer>

</body>
</html>
