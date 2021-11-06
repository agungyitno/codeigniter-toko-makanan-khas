<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		isLogin();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('UserModel');
		$this->load->model('PelangganModel');
		$this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}

	public function index()
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'User';
		$data['title'] = 'Data User';
		$data['user'] = $this->UserModel->get_all(false);
	}

	public function pelanggan()
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Pelanggan';
		$data['title'] = 'Data Pelanggan';
		$data['data'] = $this->UserModel->get_by_role(2);
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/user', $data);
		$this->load->view('tamplates/footer');
	}

	public function admin()
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Admin';
		$data['title'] = 'Data Admin';
		$data['data'] = $this->UserModel->get_by_role(1);
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/user', $data);
		$this->load->view('tamplates/footer');
	}

	public function tambah_admin()
	{
		$password = password_hash($this->input->post('Password'), PASSWORD_DEFAULT);
		$this->db->select_max('id');
		$max_id = $this->db->get('user')->row();
		$index = $max_id->id;
		$gambar = 'default.png';
		if ($_FILES['Gambar']['name'] != '') {
			$upload = upload_gambar('profile', 'Gambar', $index);
			if ($upload != 'error') {
				$gambar = $upload;
			}
		}
		$data = [
			'name' => $this->input->post('Nama'),
			'email' => $this->input->post('Email'),
			'image' => $gambar,
			'password' => $password,
			'role_id' => 1,
			'is_active' => 1,
			'date_created' => time(),
		];
		$this->UserModel->insert($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert"><b>' . $this->input->post('Nama') . '</b> berhasil ditambahkan.</div>');
		redirect(base_url('user/admin'));
	}

	public function edit($jenis)
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$query = $this->db->get('user')->row();
		$password = $query->password;
		$nama = $query->name;
		if ($jenis == 'Admin') {
			$nama = $this->input->post('Nama');
		}
		if ($this->input->post('Password') != '') {
			$password = password_hash($this->input->post('Password'), PASSWORD_DEFAULT);
		}
		$data = [
			'name' => $nama,
			'password' => $password,
			'is_active' => $this->input->post('Status'),
		];
		$this->UserModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert"><b>' . $this->input->post('Nama') . '</b> berhasil diedit.</div>');
		if ($jenis == 'Admin') {
			redirect(base_url('user/admin'));
		} else {
			redirect(base_url('user/pelanggan'));
		}
	}

	public function hapus_admin()
	{
		$id = $this->input->post('id');
		$this->UserModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Admin berhasil dihapus.</div>');
		redirect(base_url('user/admin'));
	}

	public function nonaktifkan($id)
	{
		$user = $this->UserModel->get_by_id($id);
		$data = [
			'is_active' => 0,
		];
		$this->UserModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert"><b>' . $user->name . '</b> berhasil dinonaktifkan.</div>');
		redirect(base_url('user/admin'));
	}
}
