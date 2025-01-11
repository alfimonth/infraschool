<?php

$appName = $this->config->item('app_name');
$timestamp = date('d M Y H:i:s');

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

        .header .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header img {
            width: 50px;
            height: 50px;
        }
        .header .app-info {
            font-size: 14px;
            line-height: 1.2;
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
            text-align: center;
        }
        th, td {
            padding: 8px;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
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
                <div>Tahun Pelajaran 2024/2025</div>
            </div>
        </div>
        <div class="timestamp">Generated: ' . $timestamp . '</div>
    </div>
    <h3 style="text-align:center;">Log Transaksi Sarana Prasarana</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Sarpras</th>
                <th>Jenis Transaksi</th>
                <th>Jumlah</th>
                <th>Oleh</th>
            </tr>
        </thead>
        <tbody>';


// Data log
$index = 1;
foreach ($logs as $log) {
  $html .= '<tr>
        <td>' . $index++ . '</td>
        <td>' . date('d M Y - H:i', strtotime($log['tanggal'])) . '</td>
        <td>' . $log['jenis_sarpras'] . '</td>
        <td>' . ucfirst($log['tipe']) . '</td>
        <td>' . $log['jumlah'] . '</td>
        <td>' . $log['fullname'] . '</td>
    </tr>';
}

$html .= '
        </tbody>
    </table>
</body>
<script>
    window.print();
</script>
</html>';

// Tampilkan HTML untuk dicetak
echo $html;
