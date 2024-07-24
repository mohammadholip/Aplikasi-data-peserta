<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Data Simulasi</title>
</head>

<body>
    <header>
        <h1>Ubah Data Peserta</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tambahdata.php">Tambah Data</a></li>
            <li><a href="ubahdata.php">Ubah Data</a></li>
        </ul>
    </nav>
    <main>
        <?php
        $file = 'data_peserta.txt';
        $data = [];
        if (file_exists($file)) {
            $fp = fopen($file, 'r');
            if ($fp) {
                while (($line = fgets($fp)) !== false) {
                    preg_match('/Nama: (.*), Jenis Kelamin: (.*), Tanggal Lahir: (.*)/', $line, $matches);
                    if (count($matches) == 4) {
                        $data[] = [
                            'nama' => htmlspecialchars($matches[1]),
                            'jeniskelamin' => htmlspecialchars($matches[2]),
                            'tanggallahir' => htmlspecialchars($matches[3])
                        ];
                    }
                }
                fclose($fp);
            }
        }
        ?>

        <!-- Form to select the record to edit -->
        <form action="ubahdata.php" method="post">
            <fieldset>
                <legend>Pilih Data untuk Diedit</legend>
                <div class="content">
                    <div class="content-kiri">
                        <table>
                            <tr>
                                <td class="label">Pilih Nama Peserta</td>
                                <td>
                                    <select name="selected_nama" id="selectNama" required>
                                        <option value="">-- Pilih Nama --</option>
                                        <?php foreach ($data as $record) : ?>
                                            <option value="<?php echo htmlspecialchars($record['nama']); ?>">
                                                <?php echo htmlspecialchars($record['nama']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="content-kanan">
                        <button type="submit" name="pilih" class="input-btn">Pilih</button>
                    </div>
                </div>
            </fieldset>
        </form>

        <?php if (isset($_POST['pilih'])) : ?>
            <?php
            $selected_nama = htmlspecialchars($_POST['selected_nama']);
            $selected_record = null;
            foreach ($data as $record) {
                if ($record['nama'] === $selected_nama) {
                    $selected_record = $record;
                    break;
                }
            }
            ?>
            <!-- Form to edit the selected record -->
            <form action="ubahvalidasi.php" method="post">
                <fieldset>
                    <legend>Edit Data Peserta</legend>
                    <div class="content">
                        <div class="content-kiri">
                            <table>
                                <tr>
                                    <td class="label">Nama Peserta</td>
                                    <td>
                                        <input type="text" name="nama" id="inputTeks" maxlength="60" value="<?php echo $selected_record['nama']; ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Jenis Kelamin</td>
                                    <td>
                                        <select name="jeniskelamin" id="" required>
                                            <option value="Laki-laki" <?php echo $selected_record['jeniskelamin'] === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php echo $selected_record['jeniskelamin'] === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Tanggal Lahir</td>
                                    <td>
                                        <input type="date" name="tanggallahir" id="" value="<?php echo $selected_record['tanggallahir']; ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="old_nama" value="<?php echo $selected_record['nama']; ?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="content-kanan">
                            <button type="submit" name="ubah" class="input-btn">Simpan Perubahan</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Mohammad holip.</p>
    </footer>
</body>

</html>