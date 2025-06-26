<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - El-Portfolio</title>
    <style>
        html, body { overflow-x: hidden; }
        body { 
                font-family: 'Montserrat', Arial, sans-serif; 
            margin: 0;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            position: relative;
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
        .container { 
            max-width: 900px; 
            margin: 40px auto; 
            background: rgba(255,255,255,0.7); 
            padding: 32px; 
            border-radius: 18px; 
            box-shadow: 0 8px 32px rgba(70,142,172,0.13);
            position: relative;
            z-index: 1;
        }
        h1 {
            text-align: center; 
            color: #468EAC; 
            font-size: 2rem;
            margin-bottom: 36px;
            letter-spacing: 1px;
        }
        .article-list { list-style: none; padding: 0; }
        .article-item {
            display: flex;
            align-items: center;
            gap: 32px;
            flex-wrap: wrap;
            margin-bottom: 44px;
            background: rgba(255,255,255,0.55);
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(70,142,172,0.10);
            padding: 24px 18px;
            position: relative;
            transition: box-shadow 0.2s, transform 0.2s;
            border: 1.5px solid #e0eafc;
        }
        .article-item:hover {
            box-shadow: 0 8px 32px rgba(70,142,172,0.18);
            transform: translateY(-2px) scale(1.01);
        }
        .article-item img {
            width: 220px;
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(70,142,172,0.10);
            transition: transform 0.22s, box-shadow 0.22s;
            background: #fff;
        }
        .article-item:hover img {
            transform: scale(1.05) rotate(-2deg);
            box-shadow: 0 8px 32px rgba(70,142,172,0.18);
        }
        .article-content {
            flex: 1;
            min-width: 220px;
        }
        .article-content h3 {
            margin-bottom: 8px;
            font-size: 1.35rem;
            background: linear-gradient(90deg, #468EAC 40%, #74ebd5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .article-content p {
            line-height: 1.8; 
            color: #2b5876;
            font-size: 1.04rem;
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
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    background: linear-gradient(45deg, #fff, #e6f3fa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
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

/* Hover effects per platform */
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

/* Responsive */
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
        <h1>Artikel Seputar Videografi, Fotografi, Editing, dan Drone</h1>
        <?php
        include 'koneksi.php';
        $artikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id ASC");
        ?>
        <ul class="article-list">
            <?php $i = 0; while($row = mysqli_fetch_assoc($artikel)): $i++; ?>
            <li class="article-item" style="<?php echo $i % 2 == 0 ? 'flex-direction:row-reverse;' : ''; ?>">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>">
                <div class="article-content">
                    <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
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
        <p><i class="icon">📧</i> luthfilkn@gmail.com</p>
        <p><i class="icon">📱</i> +62 895 6294 79009</p>
        <p><i class="icon">📍</i> Tanjungpinang, Indonesia</p>
      </div>
    </div>
    
    <div class="footer-section">
      <h4 class="footer-heading">Social Media</h4>
      <div class="social-links">
        <a href="#" class="social-link" title="LinkedIn"><img src="assets/linkedin.png" alt="LinkedIn" class="social-icon"></a>
        <a href="#" class="social-link" title="GitHub"><img src="assets/github.png" alt="GitHub" class="social-icon"></a>
        <a href="#" class="social-link" title="Instagram"><img src="assets/ig.png" alt="Instagram" class="social-icon"></a>
        <a href="#" class="social-link" title="YouTube"><img src="assets/yt.png" alt="YouTube" class="social-icon"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="footer-bottom-content">
      <p>&copy; 2025 El-Portfolio. All rights reserved.</p>
      <p>Made with ❤️ by Luthfi Kurniawan</p>
    </div>
  </div>
</footer>

</body>
</html>