<?php
include 'koneksi.php';

// Handle update biodata
if (isset($_POST['update_biodata'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "UPDATE biodata SET nama='$nama', email='$email', telepon='$telepon', alamat='$alamat' WHERE id=1");
}

// Handle update skill
if (isset($_POST['update_skill'])) {
    mysqli_query($conn, "DELETE FROM skill");
    foreach ($_POST['skill'] as $skill) {
        $skill = mysqli_real_escape_string($conn, $skill);
        if ($skill != '') {
            mysqli_query($conn, "INSERT INTO skill (nama) VALUES ('$skill')");
        }
    }
}

// Proses update project
if (isset($_POST['update_project'])) {
    mysqli_query($conn, "DELETE FROM project");
    foreach ($_POST['project_judul'] as $i => $judul) {
        $judul = mysqli_real_escape_string($conn, $judul);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['project_deskripsi'][$i]);
        if ($judul != '') {
            mysqli_query($conn, "INSERT INTO project (judul, deskripsi) VALUES ('$judul', '$deskripsi')");
        }
    }
}

// Handle update education
if (isset($_POST['update_education'])) {
    mysqli_query($conn, "DELETE FROM education");
    foreach ($_POST['edu_nama'] as $i => $nama) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $jurusan = mysqli_real_escape_string($conn, $_POST['edu_jurusan'][$i]);
        $tahun = mysqli_real_escape_string($conn, $_POST['edu_tahun'][$i]);
        if ($nama != '') {
            mysqli_query($conn, "INSERT INTO education (nama, jurusan, tahun) VALUES ('$nama', '$jurusan', '$tahun')");
        }
    }
}

// Handle update experience
if (isset($_POST['update_experience'])) {
    mysqli_query($conn, "DELETE FROM experience");
    foreach ($_POST['exp_posisi'] as $i => $posisi) {
        $posisi = mysqli_real_escape_string($conn, $posisi);
        $tempat = mysqli_real_escape_string($conn, $_POST['exp_tempat'][$i]);
        $tahun = mysqli_real_escape_string($conn, $_POST['exp_tahun'][$i]);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['exp_deskripsi'][$i]);
        if ($posisi != '') {
            mysqli_query($conn, "INSERT INTO experience (posisi, tempat, tahun, deskripsi) VALUES ('$posisi', '$tempat', '$tahun', '$deskripsi')");
        }
    }
}

// Proses update organisasi
if (isset($_POST['update_organisasi'])) {
    mysqli_query($conn, "DELETE FROM organisasi");
    foreach ($_POST['org_nama'] as $i => $nama) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $jabatan = mysqli_real_escape_string($conn, $_POST['org_jabatan'][$i]);
        $tahun = mysqli_real_escape_string($conn, $_POST['org_tahun'][$i]);
        if ($nama != '') {
            mysqli_query($conn, "INSERT INTO organisasi (nama, jabatan, tahun) VALUES ('$nama', '$jabatan', '$tahun')");
        }
    }
}
// Ambil data
$biodata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM biodata WHERE id=1"));
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
    <title>Admin Edit Portofolio</title>
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            margin: 0;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: rgba(255,255,255,0.65);
            padding: 38px 24px 32px 24px;
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(70,142,172,0.13), 0 2px 8px rgba(70,142,172,0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h1 {
            color: #468EAC;
            text-align: center;
            margin-bottom: 32px;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 1px;
        }
        h2 {
            color: #468EAC;
            margin-top: 36px;
            margin-bottom: 18px;
            font-size: 1.25rem;
            font-weight: 700;
        }
        label {
            font-weight: 600;
            color: #2b5876;
            margin-top: 10px;
            display: block;
        }
        input, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border-radius: 8px;
            border: 1.5px solid #e0eafc;
            font-family: inherit;
            font-size: 1rem;
            background: #fafdff;
            transition: border 0.18s, box-shadow 0.18s;
            box-sizing: border-box;
        }
        input:focus, textarea:focus {
            border: 1.5px solid #468EAC;
            outline: none;
            box-shadow: 0 2px 8px rgba(70,142,172,0.10);
        }
        button, .add-btn {
            margin-top: 18px;
            background: linear-gradient(90deg, #468EAC 60%, #74ebd5 100%);
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(70,142,172,0.10);
            transition: background 0.18s, transform 0.18s;
        }
        button:hover, .add-btn:hover {
            background: linear-gradient(90deg, #74ebd5 60%, #468EAC 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .section {
            margin-bottom: 36px;
            background: rgba(255,255,255,0.85);
            border-radius: 18px;
            box-shadow: 0 1px 6px rgba(70,142,172,0.06);
            padding: 24px 20px;
        }
        .multi-input {
            margin-bottom: 14px;
            border-bottom: 1px solid #e0eafc;
            padding-bottom: 10px;
            border-radius: 8px;
            background: #fafdff;
            box-shadow: 0 1px 4px rgba(70,142,172,0.03);
        }
        .navbar-link {
            color: #468EAC;
            text-decoration: none;
            margin-right: 12px;
        }
        .add-btn {
            background: #e6f3fa;
            color: #468EAC;
            border: 1px solid #468EAC;
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 8px;
            font-weight: 700;
            margin-right: 10px;
            box-shadow: none;
            transition: background 0.18s, color 0.18s, border 0.18s;
        }
        .add-btn:hover {
            background: #468EAC;
            color: #fff;
            border: 1px solid #74ebd5;
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
        @media (max-width: 700px) {
            .container { padding: 12px 2vw; }
            h1 { font-size: 1.2rem; }
            .section { padding: 12px 4px; }
            input, textarea { font-size: 0.97rem; }
        }
    </style>
    <script>
    // Tambah input dinamis
    function addInput(section) {
        if(section === 'project') {
            let container = document.getElementById('project-container');
            let html = `<div class="multi-input">
                <input type="text" name="project_judul[]" placeholder="Judul Project">
                <textarea name="project_deskripsi[]" placeholder="Deskripsi"></textarea>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
        else if(section === 'education') {
            let container = document.getElementById('education-container');
            let html = `<div class="multi-input">
                <input type="text" name="edu_nama[]" placeholder="Nama Sekolah/Kampus">
                <input type="text" name="edu_jurusan[]" placeholder="Jurusan">
                <input type="text" name="edu_tahun[]" placeholder="Tahun">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
        else if(section === 'experience') {
            let container = document.getElementById('experience-container');
            let html = `<div class="multi-input">
                <input type="text" name="exp_posisi[]" placeholder="Posisi">
                <input type="text" name="exp_tempat[]" placeholder="Tempat">
                <input type="text" name="exp_tahun[]" placeholder="Tahun">
                <textarea name="exp_deskripsi[]" placeholder="Deskripsi"></textarea>
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
        else if(section === 'organisasi') {
            let container = document.getElementById('organisasi-container');
            let html = `<div class="multi-input">
                <input type="text" name="org_nama[]" placeholder="Nama Organisasi">
                <input type="text" name="org_jabatan[]" placeholder="Jabatan">
                <input type="text" name="org_tahun[]" placeholder="Tahun">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
        }
    }
    </script>
</head>
<body>
    <div class="container">
        <h1>Edit Semua Data Portofolio</h1>

        <!-- Biodata -->
        <form method="post" class="section">
            <h2>Biodata</h2>
            <label>Nama</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($biodata['nama']); ?>" required>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($biodata['email']); ?>" required>
            <label>Telepon</label>
            <input type="text" name="telepon" value="<?php echo htmlspecialchars($biodata['telepon']); ?>" required>
            <label>Alamat</label>
            <textarea name="alamat" required><?php echo htmlspecialchars($biodata['alamat']); ?></textarea>
            <button type="submit" name="update_biodata">Simpan Biodata</button>
        </form>

        <!-- Skill Set -->
        <form method="post" class="section">
            <h2>Skill Set</h2>
            <div id="skill-container">
                <?php while($row = mysqli_fetch_assoc($skills)): ?>
                <div class="multi-input">
                    <input type="text" name="skill[]" value="<?php echo htmlspecialchars($row['nama']); ?>">
                </div>
                <?php endwhile; ?>
                <div class="multi-input"><input type="text" name="skill[]" placeholder="Skill"></div>
            </div>
            <button type="button" class="add-btn" onclick="addInput('skill')">+ Tambah Skill</button>
            <button type="submit" name="update_skill">Simpan Skill</button>
        </form>

        <!-- Project -->
        <form method="post" class="section">
            <h2>Project</h2>
            <div id="project-container">
                <?php while($row = mysqli_fetch_assoc($projects)): ?>
                <div class="multi-input">
                    <input type="text" name="project_judul[]" value="<?php echo htmlspecialchars($row['judul']); ?>" placeholder="Judul Project">
                    <textarea name="project_deskripsi[]" placeholder="Deskripsi"><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>
                <?php endwhile; ?>
                <div class="multi-input">
                    <input type="text" name="project_judul[]" placeholder="Judul Project">
                    <textarea name="project_deskripsi[]" placeholder="Deskripsi"></textarea>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addInput('project')">+ Tambah Project</button>
            <button type="submit" name="update_project">Simpan Project</button>
        </form>

        <!-- Education -->
        <form method="post" class="section">
            <h2>Education</h2>
            <div id="education-container">
                <?php while($row = mysqli_fetch_assoc($educations)): ?>
                <div class="multi-input">
                    <input type="text" name="edu_nama[]" value="<?php echo htmlspecialchars($row['nama']); ?>" placeholder="Nama Sekolah/Kampus">
                    <input type="text" name="edu_jurusan[]" value="<?php echo htmlspecialchars($row['jurusan']); ?>" placeholder="Jurusan">
                    <input type="text" name="edu_tahun[]" value="<?php echo htmlspecialchars($row['tahun']); ?>" placeholder="Tahun">
                </div>
                <?php endwhile; ?>
                <div class="multi-input">
                    <input type="text" name="edu_nama[]" placeholder="Nama Sekolah/Kampus">
                    <input type="text" name="edu_jurusan[]" placeholder="Jurusan">
                    <input type="text" name="edu_tahun[]" placeholder="Tahun">
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addInput('education')">+ Tambah Education</button>
            <button type="submit" name="update_education">Simpan Education</button>
        </form>

        <!-- Experience -->
        <form method="post" class="section">
            <h2>Experience</h2>
            <div id="experience-container">
                <?php while($row = mysqli_fetch_assoc($experiences)): ?>
                <div class="multi-input">
                    <input type="text" name="exp_posisi[]" value="<?php echo htmlspecialchars($row['posisi']); ?>" placeholder="Posisi">
                    <input type="text" name="exp_tempat[]" value="<?php echo htmlspecialchars($row['tempat']); ?>" placeholder="Tempat">
                    <input type="text" name="exp_tahun[]" value="<?php echo htmlspecialchars($row['tahun']); ?>" placeholder="Tahun">
                    <textarea name="exp_deskripsi[]" placeholder="Deskripsi"><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                </div>
                <?php endwhile; ?>
                <div class="multi-input">
                    <input type="text" name="exp_posisi[]" placeholder="Posisi">
                    <input type="text" name="exp_tempat[]" placeholder="Tempat">
                    <input type="text" name="exp_tahun[]" placeholder="Tahun">
                    <textarea name="exp_deskripsi[]" placeholder="Deskripsi"></textarea>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addInput('experience')">+ Tambah Experience</button>
            <button type="submit" name="update_experience">Simpan Experience</button>
        </form>

        <!-- Organisasi -->
        <form method="post" class="section">
            <h2>Organisasi</h2>
            <div id="organisasi-container">
                <?php while($row = mysqli_fetch_assoc($organisasis)): ?>
                <div class="multi-input">
                    <input type="text" name="org_nama[]" value="<?php echo htmlspecialchars($row['nama']); ?>" placeholder="Nama Organisasi">
                    <input type="text" name="org_jabatan[]" value="<?php echo htmlspecialchars($row['jabatan']); ?>" placeholder="Jabatan">
                    <input type="text" name="org_tahun[]" value="<?php echo htmlspecialchars($row['tahun']); ?>" placeholder="Tahun">
                </div>
                <?php endwhile; ?>
                <div class="multi-input">
                    <input type="text" name="org_nama[]" placeholder="Nama Organisasi">
                    <input type="text" name="org_jabatan[]" placeholder="Jabatan">
                    <input type="text" name="org_tahun[]" placeholder="Tahun">
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addInput('organisasi')">+ Tambah Organisasi</button>
            <button type="submit" name="update_organisasi">Simpan Organisasi</button>
        </form>

        <!-- Activity -->
        <form method="post" class="section">
            <h2>Activity</h2>
            <textarea name="activity" rows="5"><?php echo htmlspecialchars($activity['deskripsi'] ?? ''); ?></textarea>
            <button type="submit" name="update_activity">Simpan Activity</button>
        </form>
        <a href="admin.php" class="back-btn">Kembali ke Admin</a>
    </div>
</body>
</html>