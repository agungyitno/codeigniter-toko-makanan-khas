<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('KategoriModel');
		$this->load->model('KeranjangModel');
		$this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}
	public function index()
	{
		$data['title'] = 'Tentang';
		$data['user'] = $this->loggedUser;
		if ($this->loggedUser != null) {
			$data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
		} else {
			$data['totalCart'] =  0;
		}
		$data['kategori'] = $this->KategoriModel->get_all();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/home_topbar', $data);
		$this->load->view('tentang', $data);
		$this->load->view('tamplates/footer');
	}
}
