<?php

$appName = $this->config->item('app_name');
date_default_timezone_set('Asia/Jakarta');

// Gunakan IntlDateFormatter untuk format tanggal lokal
$formatter = new IntlDateFormatter(
    'id_ID',
    IntlDateFormatter::FULL,
    IntlDateFormatter::FULL,
    'Asia/Jakarta',
    IntlDateFormatter::GREGORIAN
);
$formatter->setPattern('d MMMM yyyy HH:mm:ss');
$timestamp = $formatter->format(new DateTime());

// Ambil path logo
$path = $_SERVER['DOCUMENT_ROOT'] . "/infraschool/public/assets/img/is.png";
if (file_exists($path)) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
} else {
    die('Gambar tidak ditemukan di path: ' . $path);
}

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header img {
            width: 50px;
            height: 50px;
        }
        .header .app-info {
            font-size: 14px;
            font-weight: bold;
        }
        .header .timestamp {
            font-size: 12px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="' . $base64 . '" alt="Logo">
            <div class="app-info">
                <div>SARANA PRASARANA</div>
                <div>SMK AL FATAH BANJARNEGARA</div>
                <div>Tahun Pelajaran ' . getTahunAjaran() . '</div>
            </div>
        </div>
        <div class="timestamp">Generated: ' . $timestamp . '</div>
    </div>';

// Section General Info
$index = 1;
foreach ($general_info as $info) {
    $html .= '<div">' . $index . '. ' . $info['jenis'] . ' = ' . $info['value'] . ' ' . $info['satuan'] . '</div><br>';
    $index++;
}

// Section Ruang
$html .= '<div class="section-title">Daftar Ruang</div>
<table>
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Ruang</th>
            <th>Kategori</th>
            <th>Ukuran</th>
            <th>Baik</th>
            <th>Rusak</th>
        </tr>
    </thead>
    <tbody>';

$index = 0;
foreach ($ruang as $ruang) {
    $html .= '<tr>
    <td>' . $index++ . '</td>
    <td>' . $ruang['jenis'] . '</td>
        <td>' . $ruang['kategori_nama'] . '</td>
        <td>' . $ruang['panjang'] . ' x ' . $ruang['lebar'] . ' m' .  '<sup>2</sup>' . '</td>
        <td>' . $ruang['baik'] . '</td>
        <td>' . $ruang['rusak'] . '</td>
    </tr>';
}
$html .= '</tbody>
</table>';

$index = 0;
// Section Peralatan
$html .= '<div class="section-title">Daftar Peralatan</div>
<table>
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Peralatan</th>
            <th>Kategori</th>
            <th>Baik</th>
            <th>Rusak</th>
        </tr>
    </thead>
    <tbody>';
foreach ($peralatan as $peralatan) {
    $html .= '<tr>
    <td>' . $index++ . '</td>
    <td>' . $peralatan['jenis'] . '</td>
        <td>' . $peralatan['kategori_nama'] . '</td>
        <td>' . $peralatan['baik'] . '</td>
        <td>' . $peralatan['rusak'] . '</td>
    </tr>';
}
$html .= '</tbody>
</table>';

$html .= '
</body>
<script>
    window.print();
</script>
</html>';

echo $html;
