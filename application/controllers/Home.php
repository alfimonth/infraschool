<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property ModelUtama $ModelUtama
 */
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelUtama');
	}
	public function index()
	{
		$data['title'] = 'Home';
		$data['general_info'] = $this->ModelUtama->getData();


		$this->load->view('templates/main_header', $data);
		$this->load->view('home');
		$this->load->view('templates/main_footer');
	}
}
