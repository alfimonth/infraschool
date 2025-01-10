<?php
require 'vendor/autoload.php'; // Pastikan PhpSpreadsheet diinstal via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header tabel
$headers = ['No', 'Tanggal', 'Nama Sarpras', 'Jenis Transaksi', 'Jumlah', 'Oleh'];
$sheet->fromArray($headers, null, 'A1'); // Tambahkan header mulai dari baris ke-1
$sheet->getStyle('A1:F1')->getFont()->setBold(true); // Buat header bold
$sheet->getStyle('A1:F1')->getAlignment()->setHorizontal('center');

// Data tabel
$data = [];
$index = 1;
foreach ($logs as $log) {
  $data[] = [
    $index++,
    date('d M Y - H:i', strtotime($log['tanggal'])),
    $log['jenis_sarpras'],
    ucfirst($log['tipe']),
    $log['jumlah'],
    $log['fullname']
  ];
}

// Tambahkan data ke tabel, mulai dari baris ke-2
$sheet->fromArray($data, null, 'A2');

// Buat format sebagai tabel (seperti CTRL+T di Excel)
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();
$tableRange = "A1:{$highestColumn}{$highestRow}";
$table = new Table($tableRange);
$sheet->addTable($table);

// Opsi auto-size kolom
foreach (range('A', $highestColumn) as $col) {
  $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Simpan sebagai file Excel
$filename = 'Log_Transaksi_Sarpras.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
