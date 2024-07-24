<?php
if (isset($_POST['ubah'])) {
    $file = 'data_peserta.txt';
    $old_nama = htmlspecialchars($_POST['old_nama']);
    $new_nama = htmlspecialchars($_POST['nama']);
    $jeniskelamin = htmlspecialchars($_POST['jeniskelamin']);
    $tanggallahir = htmlspecialchars($_POST['tanggallahir']);

    // Read all lines from file
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Open the file for writing
    $fp = fopen($file, 'w');

    if ($fp) {
        foreach ($lines as $line) {
            // If the line contains the old name, update it
            if (strpos($line, "Nama: $old_nama") !== false) {
                $line = "Nama: $new_nama, Jenis Kelamin: $jeniskelamin, Tanggal Lahir: $tanggallahir";
            }
            fwrite($fp, $line . PHP_EOL);
        }
        fclose($fp);
        header("Location: ubahdata.php?sukses=Data berhasil diubah");
    } else {
        header("Location: ubahdata.php?error=Gagal menulis ke file");
    }
}
?>
