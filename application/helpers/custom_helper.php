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
