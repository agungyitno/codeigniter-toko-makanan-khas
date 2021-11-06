<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		isLogin();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('ProdukModel');
		$this->load->model('KategoriModel');
		$this->load->model('PesanModel');
		$this->load->model('PembayaranModel');
		$this->load->model('SatuanModel');
		$this->load->model('UserModel');
		$this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	}
	public function index()
	{
		$data['title'] = 'Beranda';
		$data['user'] = $this->loggedUser;
		$data['total_pesanan'] = $this->PesanModel->total_rows();
		$data['pesanan_belum_bayar'] = $this->PesanModel->total_rows_by_state('Belum Bayar');
		$data['pesanan_dibayar'] = $this->PesanModel->total_rows_by_state('Dibayar');
		$data['pesanan_diproses'] = $this->PesanModel->total_rows_by_state('Diproses');
		$data['pesanan_dikirim'] = $this->PesanModel->total_rows_by_state('Dikirim');
		$data['pesanan_selesai'] = $this->PesanModel->total_rows_by_state('Selesai');
		$data['total_produk'] = $this->ProdukModel->total_rows();
		$data['total_pembayaran'] = $this->PembayaranModel->total_rows();
		$data['total_user'] = $this->UserModel->total_rows();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('tamplates/footer');
	}
	/*
	==================== Produk ====================
*/
	public function produk($id = '')
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Produk';
		if ($id != '') {
			$data['title'] = 'Detail Produk';
			$data['produk'] = $this->ProdukModel->get_by_id($id);
			$data['kategori'] = $this->KategoriModel->get_all();
			$data['satuan'] = $this->SatuanModel->get_all();
			$this->load->view('tamplates/header', $data);
			$this->load->view('tamplates/sidebar', $data);
			$this->load->view('tamplates/topbar', $data);
			$this->load->view('admin/produk_detail', $data);
			$this->load->view('tamplates/footer');
		} else {
			$data['title'] = 'Data Produk';
			$data['produk'] = $this->ProdukModel->get_all();
			$data['kategori'] = $this->KategoriModel->get_all();
			$data['satuan'] = $this->SatuanModel->get_all();
			$this->load->view('tamplates/header', $data);
			$this->load->view('tamplates/sidebar', $data);
			$this->load->view('tamplates/topbar', $data);
			$this->load->view('admin/produk', $data);
			$this->load->view('tamplates/footer');
		}
	}

	public function tambah_produk()
	{
		$this->db->select_max('id_produk');
		$query = $this->db->get('tbl_produk')->result_array();
		$index = (intval($query[0]['id_produk']) + 1);
		$gambar = 'default.jpg';
		if ($_FILES['Gambar']['name'] != '') {
			$upload = upload_gambar('produk', 'Gambar', $index);
			if ($upload != 'error') {
				$gambar = $upload;
			}
		}
		$data = [
			'nama_produk' => $this->input->post('Nama'),
			'kategori_id' => $this->input->post('Kategori'),
			'stok' => $this->input->post('Stok'),
			'satuan_id' => $this->input->post('Satuan'),
			'harga' => $this->input->post('Harga'),
			'gambar' => $gambar,
			'deskripsi' => $this->input->post('Deskripsi'),
		];

		$this->ProdukModel->insert($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Produk berhasil ditambahkan.</div>');
		redirect(base_url('admin/produk'));
	}

	public function edit_produk()
	{
		$id = $this->input->post('id');
		$this->db->select('gambar');
		$this->db->where('id_produk', $id);
		$dbGambar = $this->db->get('tbl_produk')->result_array();
		$gambar = $dbGambar[0]['gambar'];
		if ($_FILES['Gambar']['name'] != '') {
			$upload = upload_gambar('produk', 'Gambar', $id);
			if ($upload != 'error') {
				$gambar = $upload;
			}
		}
		$data = [
			'nama_produk' => $this->input->post('Nama'),
			'kategori_id' => $this->input->post('Kategori'),
			'stok' => $this->input->post('Stok'),
			'satuan_id' => $this->input->post('Satuan'),
			'harga' => $this->input->post('Harga'),
			'gambar' => $gambar,
			'deskripsi' => $this->input->post('Deskripsi'),
		];
		$this->ProdukModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Produk berhasil diedit.</div>');
		redirect(base_url('admin/produk'));
	}

	public function hapus_produk()
	{
		$id = $this->input->post('id');
		$this->ProdukModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Produk berhasil dihapus.</div>');
		redirect(base_url('admin/produk'));
	}
	/*
	==================== Kategori ====================
*/
	public function kategori()
	{
		$data['user'] = $this->loggedUser;
		$data['title'] = 'Kategori Produk';
		$data['modelTitle'] = 'Kategori';
		$data['kategori'] = $this->KategoriModel->get_all();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/kategori', $data);
		$this->load->view('tamplates/footer');
	}

	public function tambah_kategori()
	{
		$data = [
			'nama_kategori' => $this->input->post('Nama'),
		];
		$this->KategoriModel->insert($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Kategori berhasil ditambahkan.</div>');
		redirect(base_url('admin/kategori'));
	}

	public function edit_kategori()
	{
		$id = $this->input->post('id');
		$kategori = $this->KategoriModel->get_by_id($id);
		$data = [
			'nama_kategori' => $this->input->post('Nama'),
		];
		$this->KategoriModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Kategori berhasil diedit.</div>');
		redirect(base_url('admin/kategori'));
	}

	public function hapus_kategori()
	{
		$id = $this->input->post('id');
		$kategori = $this->KategoriModel->get_by_id($id);
		$contain = '';
		$cek = $this->ProdukModel->get_by('kategori_id', $id);
		if (count($cek) > 0) {
			foreach ($cek as $c) {
				$contain .= '- ' . $c['id_produk'] . ' | ' . $c['nama_produk'] . '<br>';
			}
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Kategori <b>' . $kategori->nama_kategori . '</b> tidak dapat dihapus. Kategori ini digunakan oleh : <br/>' . $contain . ' Ubah katagori dari produk diatas jika ingin menghapus kategori <b>' . $kategori->nama_kategori . '</b>!</div>');
			redirect(base_url('admin/kategori'));
		}
		$this->KategoriModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Kategori <b>' . $kategori->nama_kategori . '</b> berhasil dihapus.</div>');
		redirect(base_url('admin/kategori'));
	}
	/*
	==================== Satuan ====================
*/
	public function satuan()
	{
		$data['user'] = $this->loggedUser;
		$data['title'] = 'Satuan Produk';
		$data['modelTitle'] = 'Satuan';
		$data['satuan'] = $this->SatuanModel->get_all();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/satuan', $data);
		$this->load->view('tamplates/footer');
	}

	public function tambah_satuan()
	{
		$data = [
			'nama_satuan' => $this->input->post('Nama'),
		];
		$this->SatuanModel->insert($data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Satuan berhasil ditambahkan.</div>');
		redirect(base_url('admin/satuan'));
	}

	public function edit_satuan()
	{
		$id = $this->input->post('id');
		$data = [
			'nama_satuan' => $this->input->post('Nama'),
		];
		$this->SatuanModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Satuan berhasil diedit.</div>');
		redirect(base_url('admin/satuan'));
	}

	public function hapus_satuan()
	{
		$id = $this->input->post('id');
		$satuan = $this->SatuanModel->get_by_id($id);
		$contain = '';
		$cek = $this->ProdukModel->get_by('satuan_id', $id);
		if (count($cek) > 0) {
			foreach ($cek as $c) {
				$contain .= '- ' . $c['id_produk'] . ' | ' . $c['nama_produk'] . '<br>';
			}
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Satuan <b>' . $satuan->nama_satuan . '</b> tidak dapat dihapus. Satuan ini digunakan oleh : <br/>' . $contain . ' Ubah katagori dari produk diatas jika ingin menghapus satuan <b>' . $satuan->nama_satuan . '</b>!</div>');
			redirect(base_url('admin/satuan'));
		}
		$this->SatuanModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Satuan berhasil dihapus.</div>');
		redirect(base_url('admin/satuan'));
	}
	/*
	==================== Satuan ====================
*/
	public function pesanan($url = null)
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Pesanan';
		if ($url == 'filter') {
			$title = [];
			if (!empty($this->input->get('statusFilter'))) {
				$status = $this->input->get('statusFilter');
				$this->db->where('status', $status);
				$title['status'] = $status;
			}
			if (!empty($this->input->get('dariTanggal'))) {
				$from = explode('-', $this->input->get('dariTanggal'));
				$from_date = mktime(23, 59, 59, $from[1], $from[2], $from[0]);
				$this->db->where('tgl_pesanan >=', $from_date);
				$title['dari'] = $this->input->get('dariTanggal');
			}
			if (!empty($this->input->get('keTanggal'))) {
				$to = explode('-', $this->input->get('keTanggal'));
				$to_date = mktime(23, 59, 59, $to[1], $to[2], $to[0]);
				$this->db->where('tgl_pesanan <=', $to_date);
				$title['sampai'] = $this->input->get('keTanggal');
			}
			if (empty($title)) {
				redirect(base_url('admin/pesanan'));
			}
			$data['filter'] = $title;
			$data['title'] = 'List Pesanan';
			$this->db->join('user', 'user.id = tbl_pesanan.user_id');
			$data['pesanan'] = $this->db->get('tbl_pesanan')->result_array();
		} else {
			$data['title'] = 'List Pesanan';
			$data['pesanan'] = $this->PesanModel->get_all();
		}
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/pesanan', $data);
		$this->load->view('tamplates/footer');
	}

	public function ubah_status_pesanan()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('Status');
		$data = [
			'status' => $status,
		];
		$this->PesanModel->update($id, $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Status pesanan ' . $id . ' berhasil diubah.</div>');
		redirect(base_url('admin/pesanan'));
	}

	public function detail_pesanan($id)
	{
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Pesanan';
		$data['title'] = 'Detail Pesanan: ' . $id;
		$data['pesanan'] = $this->PesanModel->get_by_id($id);
		$data['detail'] = $this->PesanModel->get_detail($id);
           $data['bukti'] = $this->PesanModel->get_bukti_by_pesanan($id);
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/pesanan_detail', $data);
		$this->load->view('tamplates/footer');
	}

	public function pembayaran($url = null)
	{
		if ($url == 'validasi') {
			$id = $this->input->post('id');
			$get = $this->PembayaranModel->get_by_id($id);
			$validasi = $this->input->post('validasi');
			$data = [
				'is_valid' => $validasi,
				'tanggal_validasi' => time(),
			];
			$this->PembayaranModel->update($id, $data);
			if ($validasi == 'Valid') {
				$status = [
					'status' => 'Diproses',
				];
				$this->PesanModel->update($get->pesanan_id, $status);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pembayaran divalidasi!.</div>');
			redirect(base_url('admin/pembayaran'));
		}
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Pembayaran';
		$data['title'] = 'List Pembayaran';
		$data['pembayaran'] = $this->PembayaranModel->get_all();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/pembayaran', $data);
		$this->load->view('tamplates/footer');
	}

	public function rekening($url = null)
	{
		if ($url == 'tambah') {
			$data = [
				'jenis' => $this->input->post('Jenis'),
				'nama' => $this->input->post('Nama'),
				'nomor' => $this->input->post('Nomor'),
				'atas_nama' => $this->input->post('atas_nama'),
			];
			$this->PembayaranModel->insert_rekening($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Rekening berhasil ditambahkan!.</div>');
			redirect(base_url('admin/rekening'));
		} elseif ($url == 'edit') {
			$id = $this->input->post('id');
			$data = [
				'jenis' => $this->input->post('Jenis'),
				'nama' => $this->input->post('Nama'),
				'nomor' => $this->input->post('Nomor'),
				'atas_nama' => $this->input->post('atas_nama'),
			];
			$this->PembayaranModel->update_rekening($id, $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Rekening berhasil diedit!.</div>');
			redirect(base_url('admin/rekening'));
		} elseif ($url == 'hapus') {
			$id = $this->input->post('id');
			$this->PembayaranModel->delete_rekening($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Rekening berhasil dihapus!.</div>');
			redirect(base_url('admin/rekening'));
		}
		$data['user'] = $this->loggedUser;
		$data['modelTitle'] = 'Rekening';
		$data['title'] = 'List Rekening';
		$data['rekening'] = $this->PembayaranModel->get_rekening();
		$this->load->view('tamplates/header', $data);
		$this->load->view('tamplates/sidebar', $data);
		$this->load->view('tamplates/topbar', $data);
		$this->load->view('admin/rekening', $data);
		$this->load->view('tamplates/footer');
	}
}
