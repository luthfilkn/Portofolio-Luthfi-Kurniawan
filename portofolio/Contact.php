<?php
// Tidak ada pemrosesan langsung di file ini, hanya tampilan form
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - El-Portfolio</title>
    <style>
        html, body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100vw;
            box-sizing: border-box;
        }
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            margin: 0;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
        }
/* Navbar Styles */
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

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: rgba(255,255,255,0.55);
            padding: 36px 28px 28px 28px;
            border-radius: 22px;
            box-shadow: 0 8px 32px 0 rgba(70,142,172,0.13);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .about {
            text-align: center;
            margin-bottom: 32px;
            position: relative;
        }
        .about .profile-spotlight {
            position: relative;
            display: inline-block;
        }
        .about .profile-spotlight::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 210px; height: 210px;
            border-radius: 50%;
            background: radial-gradient(circle, #74ebd5cc 0%, #468EAC44 60%, transparent 80%);
            filter: blur(8px);
            z-index: 0;
            animation: spotlight-glow 2.5s infinite alternate;
        }
        @keyframes spotlight-glow {
            0% { opacity: 0.7; }
            100% { opacity: 1; filter: blur(16px);}
        }
        .about img {
            width: 170px;
            height: 170px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 0 8px #74ebd5cc, 0 8px 32px rgba(70,142,172,0.22);
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
            background: #fff;
            transition: transform 0.22s, box-shadow 0.22s;
        }
        .about img:hover {
            transform: scale(1.08) rotate(-2deg);
            box-shadow: 0 0 0 16px #74ebd5cc, 0 12px 36px rgba(70,142,172,0.28);
        }
        h1, h2 {
            color: #468EAC;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
            text-align: center;
            line-height: 1.8;
            font-size: 1.08rem;
        }
        #social-media {
            margin: 40px 0;
        }
        #social-media h2 {
            margin-bottom: 18px;
        }
        #social-media .social-icons {
            display: flex;
            justify-content: center;
            gap: 32px;
        }
        
        #social-media a:hover {
            transform: scale(1.12) rotate(-4deg);
            box-shadow: 0 6px 18px rgba(70,142,172,0.18);
        }
        #social-media img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #fff;
        }
        form {
            background: rgba(255,255,255,0.85);
            padding: 24px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(70,142,172,0.07);
            margin-top: 18px;
            margin-bottom: 18px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            color: #468EAC;
        }
        form input, form textarea, form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1.5px solid #e0eafc;
            border-radius: 6px;
            font-family: inherit;
            font-size: 1rem;
            background: #fafdff;
            transition: border 0.18s;
        }
        form input:focus, form textarea:focus, form select:focus {
            border: 1.5px solid #468EAC;
            outline: none;
        }
        form button {
            background: linear-gradient(90deg, #468EAC 60%, #74ebd5 100%);
            color: #fff;
            border: none;
            padding: 12px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.08rem;
            font-weight: 600;
            margin-top: 14px;
            transition: background 0.18s, transform 0.18s;
            box-shadow: 0 2px 8px rgba(70,142,172,0.10);
        }
        form button:hover {
            background: linear-gradient(90deg, #74ebd5 60%, #468EAC 100%);
            transform: translateY(-2px) scale(1.03);
        }
        #gmail-warning {
            color: #e74c3c;
            font-size: 0.97rem;
            margin-top: 2px;
            display: none;
        }
        #service-fee ul {
            line-height: 1.8;
            padding-left: 0;
            list-style: none;
            max-width: 600px;
            margin: 0 auto;
        }
        #service-fee li {
            margin-bottom: 14px;
            background: #fafdff;
            border-radius: 8px;
            padding: 12px 16px;
            box-shadow: 0 1px 4px rgba(70,142,172,0.04);
        }
        @media (max-width: 700px) {
            .container { padding: 12px 2vw; }
            .about img { width: 110px; height: 110px; }
            form { padding: 12px 4px; }
            #social-media .social-icons { gap: 14px; }
            #social-media img { width: 36px; height: 36px; }
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


    <div class="container"style="flex:1;">
        <div class="about">
            <span class="profile-spotlight">
                <img src="assets/profil.jpg" alt="Foto Profil">
            </span>
            <h1>Tentang Saya</h1> 
            <p style= "padding: 0 20px; font-size: 1.08rem; line-height: 1.6; color:rgb(0, 0, 0);">
                Halo! Saya <strong>Luthfi Kurniawan</strong>, mahasiswa aktif di Teknik Informatika Universitas Maritim Raja Ali Haji.
                Saat ini saya bekerja di Aivot Picture sebagai Videographer dan Editor, bertanggung jawab dalam pengambilan gambar, pengeditan video, dan produksi konten visual yang menarik.
            </p>
        </div>

        <div class="contact-info"style="margin-bottom: 100px; margin-top: 100px;">
            <h2 style="text-align:center;"> Kontak Saya </h2>
            <ul>
                <li><strong>Email:</strong> <a href="mailto:luthfilkn@email.com">luthfilkn@gmail.com</a></li>
                <li><strong>Telepon:</strong> 0895-6294-79009</li>
                <li><strong>Alamat:</strong> Tanjungpinang, Indonesia</li>
            </ul>
        </div>

        <section id="social-media" style="margin-bottom: 100px; margin-top: 100px;">
            <h2 style="text-align:center;">Social Media</h2>
            <div class="social-icons">
                <a href="https://www.linkedin.com/in/luthfilkn/" target="_blank"><img src="assets/linkedin.png" alt="LinkedIn"></a>
                <a href="https://github.com/luthfilkn" target="_blank"><img src="assets/github.png" alt="Github"></a>
                <a href="https://instagram.com/luthfilkn" target="_blank"><img src="assets/ig.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/@luthfilkn" target="_blank"><img src="assets/yt.png" alt="YouTube"></a>
            </div>
        </section>

        <section id="form-fill style= margin-bottom: 60px;">
            <h2 style="text-align:center;">Contact Form</h2>
            <form action="proses_form.php" method="post">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required 
                       pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                       title="Email harus menggunakan @gmail.com"
                       oninput="validateGmail(this)">
                <small id="gmail-warning" style="color:red; display:none;">
                    Wajib menggunakan @gmail.com
                </small>

                <label for="whatsapp">Nomor Whatsapp:</label>
                <input type="text" id="whatsapp" name="whatsapp" required>

                <label for="jasa">Jenis jasa yang ingin dipesan:</label>
                <select id="jasa" name="jasa" required>
                    <option value="">-- Pilih Jasa --</option>
                    <option value="Video Shoot">Video Shoot</option>
                    <option value="Video Editing">Video Editing</option>
                    <option value="Photo Shoot">Photo Shoot</option>
                    <option value="Photo Editing">Photo Editing</option>
                    <option value="Drone Shoot">Drone Shoot</option>
                </select>

                <button type="submit">Kirim</button>
            </form>

            <script>
            function validateGmail(input) {
                const warning = document.getElementById('gmail-warning');
                warning.style.display = input.value.endsWith('@gmail.com') ? 'none' : 'block';
            }
            </script>
        </section>

        <section id="service-fee" style="margin-bottom: 100px; margin-top: 100px;">
          <h2 style="text-align:center; ">Service Fee</h2>
          <ul style="line-height: 1.8;">
            <li>
              <strong>Video Shoot: Rp 500.000 - Rp 750.000</strong><br>
              <span>
                Pengambilan video profesional untuk berbagai kebutuhan, seperti acara, promosi, dokumentasi, dan lainnya.
              </span>
            </li>
            <li>
              <strong>Video Editing: Rp 500.000 - Rp 700.000</strong><br>
              <span>
                Pengeditan video dengan kualitas tinggi, termasuk penambahan efek, transisi, dan penyempurnaan audio.
              </span>
            </li>
            <li>
              <strong>Photo Shoot: Rp 500.000 - Rp 650.000</strong><br>
              <span>
                Pengambilan foto profesional untuk berbagai acara, seperti pernikahan, acara perusahaan, atau sesi pribadi.
              </span>
            </li>
            <li>
                <strong>Photo Editing: Rp 500.000 - Rp 600.000</strong><br>
                <span>
                Pengeditan foto dengan kualitas tinggi, termasuk penambahan efek, transisi, dan penyempurnaan audio.
            </li>
            <li>
                <strong>Drone Shoot: Rp 500.000 - Rp 700.000</strong><br>
                <span>
                Pengeditan foto dengan kualitas tinggi, termasuk penambahan efek, transisi, dan penyempurnaan audio.
            </li>
            <!-- Tambahkan jasa lain sesuai kebutuhan -->
          </ul>
        </section>
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
