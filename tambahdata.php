<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simulasi</title>
</head>
<body>
    <header>
        <h1>Tambah Data Peserta</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tambahdata.php">Tambah Data</a></li>
            <li><a href="ubahdata.php">Ubah Data</a></li>
        </ul>
    </nav>
    <main>
        <form action="validasi.php" method="post">
            <fieldset>
                <legend>Data Peserta</legend>
                <div class="content">
                    <div class="content-kiri">
                        <table>
                            <tr>
                                <td class="label">Nama Peserta</td>
                                <td>
                                    <input type="text" name="nama[]" id="inputTeks" maxlength="60" placeholder="maks 60 karakter, huruf dan spasi saja" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Jenis Kelamin</td>
                                <td>
                                    <select name="jeniskelamin[]" id="">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal Lahir</td>
                                <td>
                                    <input type="date" name="tanggallahir[]" id="" required>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="content-kanan">
                        <button type="submit" name="tambah" class="input-btn">Tambahkan</button>
                    </div>
                </div>
                <br>
                <hr>
                <?php if (isset($_GET['error'])): ?>
                <div class="pesan-error">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
                <?php endif; ?>
                <?php if (isset($_GET['sukses'])): ?>
                <div class="pesan-sukses">
                    <?php echo htmlspecialchars($_GET['sukses']); ?>
                </div>
                <?php endif; ?>
                
                <table class="tampil-table">
                    <tr class="tampil-tr">
                        <th class="tampil-th">Nama</th>
                        <th class="tampil-th">Jenis Kelamin</th>
                        <th class="tampil-th">Tanggal Lahir</th>
                    </tr>
                    <?php
                    $file = 'data_peserta.txt';
                    if (file_exists($file)) {
                        $fp = fopen($file, 'r');
                        if ($fp) {
                            while (($line = fgets($fp)) !== false) {
                                preg_match('/Nama: (.*), Jenis Kelamin: (.*), Tanggal Lahir: (.*)/', $line, $matches);
                                if (count($matches) == 4) {
                    ?>
                    <tr class="tampil-tr">
                        <td class="tampil-td"><?php echo htmlspecialchars($matches[1]); ?></td>
                        <td class="tampil-td"><?php echo htmlspecialchars($matches[2]); ?></td>
                        <td class="tampil-td"><?php echo htmlspecialchars($matches[3]); ?></td>
                    </tr>
                    <?php
                                }
                            }
                            fclose($fp);
                        }
                    }
                    ?>
                </table>
            </fieldset>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Simulasi 1. All rights reserved.</p>
    </footer>
</body>
</html>
