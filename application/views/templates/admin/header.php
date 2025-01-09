<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Admin <?= $this->config->item('app_name'); ?><?= isset($title) ? ' - ' . $title : ''; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
  <link href="<?= base_url('public/admin/css/styles.css" rel="stylesheet') ?>" />
  <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/is.ico') ?>" />

  <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <style>
    /* Sembunyikan radio button */
    .icon-options input[type="radio"] {
      display: none;
    }

    /* Gaya untuk label (ikon) */
    .icon-options .icon-label {
      display: inline-block;
      padding: 6px;
      padding-bottom: 0;
      border: 2px solid;
      cursor: pointer;
      margin-bottom: 4px;
      transition: all 0.3s ease;
    }

    .icon-options .icon-label i {
      font-size: 32px;
      color: #555;
      transition: color 0.3s ease;
    }

    /* Gaya saat radio button dipilih */
    .icon-options input[type="radio"]:checked+.icon-label {
      border-color: #007bff;
      /* Warna border ketika dipilih */
      background-color: #007bff;

      /* Warna latar belakang */
    }

    .icon-options input[type="radio"]:checked+.icon-label svg {
      color: #fff;
      font-weight: bold;
    }

    .icon-options input[type="radio"]:checked+.icon-label {
      color: #fff;
    }
  </style>
</head>

<body class="nav-fixed">
  <?php include 'navigation.php'; ?>