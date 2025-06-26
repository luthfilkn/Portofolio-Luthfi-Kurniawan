<?php
// Konfigurasi database
$host     = "localhost";
$username = "root";
$password = "";
$database = "portofolio";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$jasa     = $_POST['jasa'];

// Validasi sederhana
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !str_ends_with($email, "@gmail.com")) {
    die("Email tidak valid. Harus menggunakan @gmail.com");
}

// Simpan ke database
$sql = "INSERT INTO kontak (nama, email, whatsapp, jasa) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $email, $whatsapp, $jasa);

if ($stmt->execute()) {
    echo "<script>
        alert('Pesan berhasil dikirim!');
        window.location.href = 'contact.php';
    </script>";
} else {
    echo "Gagal menyimpan data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
