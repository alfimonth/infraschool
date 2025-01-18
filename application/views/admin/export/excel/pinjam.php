<?php
require 'vendor/autoload.php'; // Pastikan PhpSpreadsheet diinstal via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header tabel
$headers = [
  'No',
  'ID Pinjam',
  'Status',
  'Tanggal Pinjam',
  'Tanggal Kembali',
  'Nama Peminjam',
  'Email Peminjam',
  'Catatan',
  'Nama Sarpras',
  'Tipe',
  'Jumlah'
];
$sheet->fromArray($headers, null, 'A1'); // Tambahkan header mulai dari baris ke-1
$sheet->getStyle('A1:K1')->getFont()->setBold(true); // Buat header bold
$sheet->getStyle('A1:K1')->getAlignment()->setHorizontal('center');

// Data tabel
$data = [];
$index = 1;

foreach ($pinjam as $item) {
  foreach ($item['list'] as $detail) {
    $data[] = [
      $index++, // No
      $item['id_pinjam'], // ID Pinjam
      ucfirst($item['status']), // Status
      date('d M Y', strtotime($item['tgl_pinjam'])), // Tanggal Pinjam
      date('d M Y', strtotime($item['tgl_kembali'])), // Tanggal Kembali
      $item['user']['nama'], // Nama Peminjam
      $item['user']['email'], // Email Peminjam
      $item['catatan'], // Catatan
      $detail['nama_sarpras'], // Nama Sarpras
      ucfirst($detail['tipe']), // Tipe Sarpras
      $detail['jumlah'], // Jumlah
    ];
  }
}

// Tambahkan data ke tabel, mulai dari baris ke-2
$sheet->fromArray($data, null, 'A2');

// Opsi auto-size kolom
foreach (range('A', 'K') as $col) {
  $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Simpan sebagai file Excel
$filename = 'Data_Pinjam_Sarpras.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
