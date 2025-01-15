<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= isset($title) ? $title . ' | ' : ''; ?><?= $this->config->item('app_name'); ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('public/assets/is.ico') ?>" />
  <!-- Font Awesome icons (free version)-->
  <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url('public/css/styles.css') ?>?v=<?= time() ?>" rel="stylesheet" />
  <link href="<?= base_url('public/css/custom.css') ?>?v=<?= time() ?>" rel="stylesheet" />
</head>

<body>
  <?php include 'navbar.php'; ?>