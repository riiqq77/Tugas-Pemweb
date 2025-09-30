<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hasil Mahasiswa</title>
</head>
<body>
<div class="container">
    <link rel="stylesheet" href="style.css">
<?php
// Reset data
if (isset($_GET['action']) && $_GET['action'] == 'reset') {
    unset($_SESSION['database_mahasiswa']);
    header('Location: form.php');
    exit();
}

// Tambah data mahasiswa
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nama_lengkap'])) {
    $nama   = htmlspecialchars($_POST['nama_lengkap']);
    $nim    = htmlspecialchars($_POST['nim']);
    $prodi  = htmlspecialchars($_POST['program_studi']);
    $jk     = isset($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : 'Tidak dipilih';
    $hobi   = isset($_POST['hobi']) ? $_POST['hobi'] : [];
    $alamat = htmlspecialchars($_POST['alamat']);

    // Validasi sederhana
    if (!preg_match("/^[0-9]+$/", $nim)) {
        echo "<p style='color:red'>❌ NIM harus berupa angka!</p>";
    } else {
        $data_baru = [
            "nama" => $nama,
            "nim" => $nim,
            "prodi" => $prodi,
            "jenis_kelamin" => $jk,
            "hobi" => $hobi,
            "alamat" => $alamat
        ];
        $_SESSION['database_mahasiswa'][] = $data_baru;

        echo "<h3>✅ Biodata Berhasil Ditambahkan!</h3>";
    }
}

// Pencarian
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['keyword'])) {
    $keyword = htmlspecialchars($_GET['keyword']);
    if (!empty($keyword)) {
        echo "<div class='search-result'>Anda mencari data dengan kata kunci: <strong>" . $keyword . "</strong></div>";
        $hasil_pencarian = [];

        if (isset($_SESSION['database_mahasiswa'])) {
            foreach ($_SESSION['database_mahasiswa'] as $mhs) {
                if (
                    stripos($mhs['nama'], $keyword) !== false ||
                    stripos($mhs['nim'], $keyword) !== false ||
                    stripos($mhs['prodi'], $keyword) !== false ||
                    stripos($mhs['alamat'], $keyword) !== false
                ) {
                    $hasil_pencarian[] = $mhs;
                }
            }
        }

        if (!empty($hasil_pencarian)) {
            echo "<h3>Hasil Pencarian:</h3>";
            echo "<table class='result-table'>";
            echo "<tr><th>Nama</th><th>NIM</th><th>Prodi</th><th>Jenis Kelamin</th><th>Hobi</th><th>Alamat</th></tr>";
            foreach ($hasil_pencarian as $hasil) {
                echo "<tr>";
                echo "<td>{$hasil['nama']}</td>";
                echo "<td>{$hasil['nim']}</td>";
                echo "<td>{$hasil['prodi']}</td>";
                echo "<td>{$hasil['jenis_kelamin']}</td>";
                echo "<td>" . (empty($hasil['hobi']) ? '-' : implode(', ', $hasil['hobi'])) . "</td>";
                echo "<td>{$hasil['alamat']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-result'>❌ Data tidak ditemukan.</p>";
        }
    }
}

// Tampilkan semua data
if (isset($_SESSION['database_mahasiswa']) && !empty($_SESSION['database_mahasiswa'])) {
    echo "<h3>📑 Daftar Semua Mahasiswa</h3>";
    echo "<table class='result-table'>";
    echo "<tr><th>Nama</th><th>NIM</th><th>Prodi</th><th>Jenis Kelamin</th><th>Hobi</th><th>Alamat</th></tr>";
    foreach ($_SESSION['database_mahasiswa'] as $mhs) {
        echo "<tr>";
        echo "<td>{$mhs['nama']}</td>";
        echo "<td>{$mhs['nim']}</td>";
        echo "<td>{$mhs['prodi']}</td>";
        echo "<td>{$mhs['jenis_kelamin']}</td>";
        echo "<td>" . (empty($mhs['hobi']) ? '-' : implode(', ', $mhs['hobi'])) . "</td>";
        echo "<td>{$mhs['alamat']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<a href="form.php" class="back-link">⬅️ Kembali ke Form</a>
</div>
</body>
</html>
