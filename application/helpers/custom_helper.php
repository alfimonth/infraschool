<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('getProfile')) {
  function getProfile($key)
  {
    $CI = &get_instance(); // Mendapatkan instance CodeIgniter
    $user = $CI->session->userdata($key); // Sesuaikan key 'user' dengan session Anda
    if ($user) {
      return $user; // Mengembalikan data user
    }
    return null; // Mengembalikan null jika tidak ada user
  }
}

if (!function_exists('getTahunAjaran')) {
  function getTahunAjaran()
  {
    $CI = &get_instance(); // Mendapatkan instance CodeIgniter
    $CI->load->model('ModelUtama');
    return $CI->ModelUtama->getTahunAjaran();
  }
}

if (!function_exists('backPage')) {
  function backPage()
  {
    redirect($_SERVER['HTTP_REFERER']);
  }
}

if (!function_exists('dmy')) {
  function dmy($time)
  {
    return date('d-m-Y', strtotime($time));
  }
}

if (!function_exists('countAjuan')) {
  function countAjuan()
  {
    $CI = &get_instance(); // Mendapatkan instance CodeIgniter
    $CI->load->model('ModelPinjam');
    return $CI->ModelPinjam->countPengajuan();
  }
}
if (!function_exists('dd')) {

  function dd($value)
  {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();

    // Kembalikan hasil akhir
  }
}
