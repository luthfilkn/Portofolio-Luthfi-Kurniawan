<?php
include 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM biodata WHERE id=1");
$data = mysqli_fetch_assoc($result);

// Ambil data skill
$skills = mysqli_query($conn, "SELECT * FROM skill");
$projects = mysqli_query($conn, "SELECT * FROM project");
$educations = mysqli_query($conn, "SELECT * FROM education");
$experiences = mysqli_query($conn, "SELECT * FROM experience");
$organisasis = mysqli_query($conn, "SELECT * FROM organisasi");
$activity = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM activity LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El-Portofolio</title>
    <style>
        /* ...CSS lama... */
        html, body { overflow-x: hidden; }
        body { font-family: Arial, sans-serif; margin: 0; background: #f6fbfd; position: relative; }
        .container { max-width: 900px; margin: 48px auto 40px auto; background: #fff; padding: 40px 32px; border-radius: 18px; box-shadow: 0 4px 24px rgba(70,142,172,0.12); position: relative; z-index: 1; }
        .profile {
            display: flex;
            align-items: center;
            gap: 40px;
            background: rgba(255,255,255,0.25);
            border-radius: 22px;
            box-shadow: 0 8px 32px 0 rgba(70,142,172,0.18), 0 2px 8px rgba(70,142,172,0.10);
            padding: 40px 32px;
            margin-bottom: 36px;
            border: 2.5px solid #74ebd5;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2;
        }
        .profile::before {
            content: '';
            position: absolute;
            top: -40px; left: -40px;
            width: 120px; height: 120px;
            background: radial-gradient(circle, #74ebd5bb 60%, transparent 100%);
            z-index: 0;
        }
        .profile img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #468EAC;
            box-shadow: 0 4px 24px rgba(70,142,172,0.18);
            transition: transform 0.25s, box-shadow 0.25s;
            position: relative;
            z-index: 1;
            background: #fff;
        }
        .profile img:hover {
            transform: scale(1.06) rotate(-2deg);
            box-shadow: 0 8px 32px rgba(70,142,172,0.22);
        }
        .profile-info {
            position: relative;
            z-index: 1;
        }
        .profile-info h1 {
            margin-bottom: 10px;
            font-size: 2.3rem;
            background: linear-gradient(90deg, #468EAC 40%, #74ebd5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            font-weight: 800;
            letter-spacing: 1px;
        }
        .profile-info p {
            margin: 0 0 8px 0;
            font-size: 1.08rem;
            color: #2b5876;
        }
        h2 { color: #468EAC; margin-top: 40px; margin-bottom: 18px; text-align:center; }
        ul { padding-left: 20px; }
        .skills { display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; margin-bottom: 8px; }
        .skill { background: #e6f3fa; color: #468EAC; padding: 8px 20px; border-radius: 18px; font-size: 15px; font-weight: bold; box-shadow: 0 1px 4px rgba(70,142,172,0.07); }
        .section { margin-bottom: 36px; background: #fafdff; border-radius: 12px; box-shadow: 0 1px 6px rgba(70,142,172,0.06); padding: 24px 20px; }
        .project-list, .activity-list { list-style: disc; }
        .project-list li { margin-bottom: 10px; }
        .edu-exp-org { margin-bottom: 12px; }
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

/* Social Media Links - Alignment yang sempurna */
.social-links {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center; /* Memastikan semua item sejajar secara vertikal */
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
    box-sizing: border-box; /* Memastikan padding tidak mempengaruhi ukuran total */
    flex-shrink: 0; /* Mencegah shrinking yang tidak konsisten */
}

.social-icon {
    width: 24px;
    height: 24px;
    object-fit: contain;
    object-position: center; /* Memastikan logo terpusat */
    transition: all 0.3s ease;
    display: block; /* Menghilangkan space bawah pada inline elements */
}

.social-link:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.social-link:hover .social-icon {
    transform: scale(1.1);
}

/* Hover effects khusus untuk setiap platform */
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

/* Responsive untuk mobile - tetap sejajar */
@media (max-width: 768px) {
    .social-links {
        justify-content: center;
        align-items: center; /* Tetap sejajar di mobile */
    }
    
    .social-link {
        width: 40px;
        height: 40px;
        flex-shrink: 0; /* Mencegah perubahan ukuran */
    }
    
    .social-icon {
        width: 20px;
        height: 20px;
    }
}

@media (max-width: 480px) {
    .social-links {
        gap: 10px; /* Mengurangi gap di layar kecil */
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
}

</style>
</head>
<body style="min-height:100vh;display:flex;flex-direction:column;margin:0;position:relative;">
    <nav class="navbar">
    <div class="navbar-content">
        <span class="navbar-title">El-Portfolio</span>
        <div class="nav-links">
            <a href="index.php" class="navbar-link">Beranda</a>
            <a href="Article.php" class="navbar-link">Artikel</a>
            <a href="Gallery.php" class="navbar-link">Galeri</a>
            <a href="Contact.php" class="navbar-link">Kontak</a>
            <a href="Admin.php" class="navbar-link">Admin</a>
        </div>
    </div>
</nav>
    <div class="container" style="flex:1;">
        <!-- Biodata -->
        <div class="profile">
            <img src="assets/profil.jpg" alt="Foto Profil">
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($data['nama']); ?></h1>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></p>
                <p><strong>Telepon:</strong> <?php echo htmlspecialchars($data['telepon']); ?></p>
                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($data['alamat']); ?></p>
            </div>
        </div>

        <!-- Skill Set (gambar kanan) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#e6f3fa 60%,#fff 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px; flex-direction: row-reverse;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Skill.JPG" alt="Skill Set" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Skill Set</h2>
                <div class="skills">
                    <?php while($row = mysqli_fetch_assoc($skills)): ?>
                        <span class="skill"><?php echo htmlspecialchars($row['nama']); ?></span>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Project (gambar kiri) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#fff 60%,#e6f3fa 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Project.PNG" alt="Project" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Project</h2>
                <ul class="project-list">
                    <?php while($row = mysqli_fetch_assoc($projects)): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($row['judul']); ?></strong> – <?php echo htmlspecialchars($row['deskripsi']); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <a href="Gallery.php" style="display:inline-block; margin-top:20px; text-decoration:none; color:#468EAC; font-weight:bold; background:#e6f3fa; padding:8px 18px; border-radius:8px; transition:background 0.2s;">Projek Lainnya &gt;&gt;</a>
            </div>
        </div>

        <!-- Education (gambar kanan) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#e6f3fa 60%,#fff 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px; flex-direction: row-reverse;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Education.jpg" alt="Education" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Education</h2>
                <?php while($row = mysqli_fetch_assoc($educations)): ?>
                    <div class="edu-exp-org">
                        <strong><?php echo htmlspecialchars($row['nama']); ?></strong> – <?php echo htmlspecialchars($row['jurusan']); ?> (<?php echo htmlspecialchars($row['tahun']); ?>)
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Experience (gambar kiri) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#fff 60%,#e6f3fa 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Exp.jpg" alt="Experience" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Experience</h2>
                <?php while($row = mysqli_fetch_assoc($experiences)): ?>
                    <div class="edu-exp-org">
                        <strong><?php echo htmlspecialchars($row['posisi']); ?></strong> – <?php echo htmlspecialchars($row['tempat']); ?> (<?php echo htmlspecialchars($row['tahun']); ?>)
                        <br><?php echo htmlspecialchars($row['deskripsi']); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Organisasi (gambar kanan) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#e6f3fa 60%,#fff 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px; flex-direction: row-reverse;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Organisasi.JPG" alt="Organisasi" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Organisasi</h2>
                <?php while($row = mysqli_fetch_assoc($organisasis)): ?>
                    <div class="edu-exp-org">
                        <strong><?php echo htmlspecialchars($row['nama']); ?></strong> – <?php echo htmlspecialchars($row['jabatan']); ?> (<?php echo htmlspecialchars($row['tahun']); ?>)
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Activity (gambar kiri) -->
        <div class="section" style="display: flex; align-items: center; gap: 32px; flex-wrap: wrap; background: linear-gradient(120deg,#fff 60%,#e6f3fa 100%); box-shadow: 0 2px 8px rgba(70,142,172,0.08); border-radius: 16px; margin-bottom: 36px;">
            <div style="flex:0 0 150px; display:flex; justify-content:center; align-items:center;">
                <img src="assets/Activity.JPG" alt="Activity" style="width:150px; height:150px; border-radius:50%; box-shadow:0 2px 12px rgba(70,142,172,0.10); object-fit:cover; border:4px solid #468EAC;">
            </div>
            <div style="flex:1; min-width:220px;">
                <h2 style="margin-top:0;">Activity</h2>
                <p style="line-height:1.8; text-align:justify;">
                    <?php echo $activity ? $activity['deskripsi'] : ''; ?>
                </p>
            </div>
        </div>
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
                    <p><i class="icon">📧</i> <?php echo htmlspecialchars($data['email']); ?></p>
                    <p><i class="icon">📱</i> <?php echo htmlspecialchars($data['telepon']); ?></p>
                    <p><i class="icon">📍</i> <?php echo htmlspecialchars($data['alamat']); ?></p>
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
                    <a href="https://www.youtube.com/@luthfilkn" class="social-link" title="Youtube" target="_blank">
                        <img src="assets/yt.png" alt="Youtube" class="social-icon">
                    </a>
                </div>
            </div>        </div>
        
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>&copy; 2025 El-Portfolio. All rights reserved.</p>
                <p>Made with ❤️ by <?php echo htmlspecialchars($data['nama']); ?></p>
            </div>
        </div>
    </footer></body>
</html>