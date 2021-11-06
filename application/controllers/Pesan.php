<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
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
        $this->load->model('PesanModel');
        $this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function invoice()
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Pesanan';
        $data['title'] = 'Buat Pesanan';
        $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['pembayaran'] = $this->db->get('tbl_pembayaran')->result_array();
        $this->load->model('PelangganModel');
        $data['pelanggan'] = $this->PelangganModel->get_by_id($this->loggedUser['id']);
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('invoice', $data);
        $this->load->view('tamplates/footer');
    }

    public function konfirmasi()
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Pesanan';
        $data['title'] = 'Konfirmasi Pembayaran';
        $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['pembayaran'] = $this->db->get('tbl_pembayaran')->result_array();
        $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Belum Bayar', $this->loggedUser['id']);
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('konfirmasi_pembayaran', $data);
        $this->load->view('tamplates/footer');
    }

    public function confirm()
    {
        $id = $this->input->post('id');
        $bukti = '';
        if ($_FILES['Bukti']['name'] != '') {
            $upload = upload_gambar('pembayaran', 'Bukti', $id);
            if ($upload != 'error') {
                $bukti = $upload;
                $data = [
                    'pesanan_id' => $id,
                    'user_id' => $this->loggedUser['id'],
                    'bukti' => $bukti,
                    'tanggal_konfirmasi' => time(),
                    'is_valid' => 'Belum',
                ];
                $this->PesanModel->insert_bukti($data);
                $this->db->select_max('id_konfirmasi');
                $get_max = $this->db->get('tbl_konfirmasi')->row();
                $status = [
                    'status' => 'Dibayar',
                ];
                $this->PesanModel->update($id, $status);
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Bukti Pembayaran untuk pesanan ' . $id . ' berhasil dikirimkan.</div>');
                redirect(base_url('pesan/bukti_pembayaran/') . $get_max->id_konfirmasi);
                exit;
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Gambar gagal diupload, format yang didukung jpg,png,gif!</div>');
                redirect(base_url('pesan/konfirmasi'));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Bukti Pembayaran untuk pesanan ' . $id . ' gagal dikirimkan. Harap periksa inputan anda!</div>');
            redirect(base_url('pesan/konfirmasi'));
        }
    }

    public function bukti_pembayaran($id = null)
    {
        if ($id != null) {
            $data['user'] = $this->loggedUser;
            $data['modelTitle'] = 'Pesanan';
            $data['title'] = 'Konfirmasi Pembayaran';
            $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
            $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
            $data['kategori'] = $this->KategoriModel->get_all();
            $data['pembayaran'] = $this->db->get('tbl_pembayaran')->result_array();
            $data['bukti'] = $this->PesanModel->get_bukti_by_id($id);
            $this->load->view('tamplates/header', $data);
            $this->load->view('tamplates/home_topbar', $data);
            $this->load->view('struk_pembayaran', $data);
            $this->load->view('tamplates/footer');
        } else {
            redirect(base_url('pesan/konfirmasi'));
        }
    }

    public function tambah()
    {
        $len = $this->PesanModel->total_rows();
        $id_pesan = 'ORDER0001';
        if ($len > 0) {
            $get_id = $this->PesanModel->cek_id_pesan();
            $prev = substr($get_id, 5, 4);
            $cur = $prev + 1;
            $id_pesan = 'ORDER' . sprintf('%04s', $cur);
        }
        $data = [
            'id_pesanan' => $id_pesan,
            'user_id' => $this->loggedUser['id'],
            'tgl_pesanan' => time(),
            'batas_pembayaran' => strtotime(' +1 day'),
            'nama_penerima' => $this->input->post('Nama'),
            'alamat' => $this->input->post('Alamat'),
            'kode_pos' => $this->input->post('KodePos'),
            'kota' => $this->input->post('Kota'),
            'provinsi' => $this->input->post('Provinsi'),
            'no_telp' => $this->input->post('Telepon'),
            'total' => $this->input->post('Total'),
            'status' => 'Belum Bayar',
        ];
        $this->PesanModel->insert($data);
        $get_cart = $this->KeranjangModel->get_by_user($this->loggedUser['id']);
        foreach ($get_cart as $cart) {
            $data_cart = [
                'pesanan_id' => $id_pesan,
                'produk_id' => $cart['produk_id'],
                'harga' => $cart['harga'],
                'jumlah' => $cart['jumlah'],
                'sub_total' => ($cart['jumlah'] * $cart['harga']),
            ];
            $this->PesanModel->insert_detail($data_cart);
            $this->KeranjangModel->delete($cart['id_keranjang']);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pesanan berhasil dibuat. Silahkan melakukan pembayaran.</div>');
        redirect(base_url('profile/pesanan/') . $id_pesan);
    }
}
