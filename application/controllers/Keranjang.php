<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->library('form_validation');
        $this->load->model('ProdukModel');
        $this->load->model('KeranjangModel');
        $this->load->model('KategoriModel');
        $this->load->model('SatuanModel');
        $this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Keranjang';
        $data['title'] = 'Keranjang Belanja';
        $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $data['kategori'] = $this->KategoriModel->get_all();
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('keranjang', $data);
        $this->load->view('tamplates/footer');
    }

    public function tambah($id_prduk)
    {
        $jumlah = 1;
        $cek = $this->KeranjangModel->get_by_produk($this->loggedUser['id'], $id_prduk);
        if ($cek) {
            $jumlah = intval($cek->jumlah) + 1;
            $data = [
                'jumlah' => $jumlah,
            ];
            $this->db->where('id_keranjang', $cek->id_keranjang);
            $this->db->update('tbl_keranjang', $data);
        } else {
            $data = [
                'user_id' => $this->loggedUser['id'],
                'produk_id' => $id_prduk,
                'jumlah' => $jumlah,
            ];
            $this->KeranjangModel->insert($data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Produk ditambahkan ke keranjang belanja.</div>');
        redirect(base_url('keranjang'));
    }

    public function update_qty()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('jumlah');
        for ($i = 0; $i < count($id); $i++) {
            $data = [
                'jumlah' => $qty[$i],
            ];
            $this->KeranjangModel->update($id[$i], $data);
        }
        echo true;
    }

    public function hapus($id)
    {
        $this->KeranjangModel->delete($id);
        redirect(base_url('keranjang'));
    }
}
