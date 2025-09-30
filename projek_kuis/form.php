<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <div class="container">
        <link rel="stylesheet" href="style.css">
        <h2>📋 Biodata Mahasiswa</h2>

        <!-- Form Input -->
        <form action="search.php" method="POST">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>

            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" placeholder="Contoh: 2023001234" required>

            <label for="program_studi">Program Studi</label>
            <select id="program_studi" name="program_studi" required>
                <option value="">Pilih Program Studi</option>
                <option value="Informatika">Informatika</option>
                <option value="Statistika">Statistika</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Kimia">Teknik Kimia</option>
                <option value="Teknik Metalurgi">Teknik Metalurgi</option>
                <option value="Teknik Industri">Teknik Industri</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
            </select>

            <label>Jenis Kelamin</label>
            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required>
            <label for="laki" style="display: inline-block; margin-right: 20px;">Laki-laki</label>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
            <label for="perempuan" style="display: inline-block;">Perempuan</label>

            <br><br>
            <label>Hobi</label>
            <input type="checkbox" id="hobi1" name="hobi[]" value="Gaming"><label for="hobi1">Gaming</label>
            <input type="checkbox" id="hobi2" name="hobi[]" value="Fotografi"><label for="hobi2">Fotografi</label>
            <input type="checkbox" id="hobi3" name="hobi[]" value="Olahraga"><label for="hobi3">Olahraga</label>

            <br><br>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" placeholder="Masukkan alamat lengkap" required></textarea>

            <button type="submit" class="btn">✅ Submit Data</button>
        </form>

        <!-- Form Pencarian -->
        <div class="section">
            <h3>🔍 Cari Mahasiswa</h3>
            <form action="search.php" method="GET">
                <label for="keyword">Kata Kunci:</label>
                <input type="text" id="keyword" name="keyword" placeholder="Cari berdasarkan nama, NIM, prodi, alamat..." required>
                <button type="submit" class="btn">Cari</button>
            </form>
        </div>

        <!-- Reset Data -->
        <div class="section">
            <form action="search.php" method="GET">
                <button type="submit" name="action" value="reset" class="btn reset-button">🗑️ Reset Semua Data</button>
            </form>
        </div>
    </div>
</body>
</html>
