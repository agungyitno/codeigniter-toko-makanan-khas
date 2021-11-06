<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        $this->load->model('UserModel');
        $this->load->model('PelangganModel');
        $this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        if (!$this->PelangganModel->get_by_id($this->loggedUser['id'])) {
            $this->_addpelanggan();
        }
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Profile';
        if (!empty($this->input->get('pesanan'))) {
            $filter = $this->input->get('pesanan');
            if ($filter == 'semua') {
                $data['pesanan'] = $this->PesanModel->get_by_user($data['user']['id']);
            } elseif ($filter == 'belum bayar') {
                $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Belum Bayar', $data['user']['id']);
            } elseif ($filter == 'dibayar') {
                $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Dibayar', $data['user']['id']);
            } elseif ($filter == 'diproses') {
                $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Diproses', $data['user']['id']);
            } elseif ($filter == 'dikirim') {
                $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Dikirim', $data['user']['id']);
            } elseif ($filter == 'selesai') {
                $data['pesanan'] = $this->PesanModel->get_by_state_and_user('Selesai', $data['user']['id']);
            }


            $data['filter'] = $filter;
        } else {
            $data['pesanan'] = $this->PesanModel->get_by_user($data['user']['id']);
        }
        $data['title'] = 'Profile ' . $this->loggedUser['name'];
        $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['u_now'] = $this->UserModel->get_by_id($this->loggedUser['id']);
        $data['pelanggan'] = $this->PelangganModel->get_by_id($this->loggedUser['id']);
        $this->db->where('id', $this->loggedUser['role_id']);
        $data['r_now'] = $this->db->get('user_role')->row_array();
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('profile/profile', $data);
        $this->load->view('tamplates/footer');
    }

    public function _addpelanggan()
    {
        $data = [
            'user_id' => $this->loggedUser['id'],
            'nama' => $this->loggedUser['name'],
        ];
        $this->PelangganModel->insert($data);
    }

    public function edit()
    {
        if (empty($this->input->post('Nama'))) {
            redirect('profile');
        }
        $id = $this->loggedUser['id'];
        $query = $this->UserModel->get_by_id($id);
        $password = $query->password;
        $foto = $query->image;
        if ($this->input->post('Password') != '') {
            $password = $this->input->post('Password');
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        if ($_FILES['Foto']['name'] != '') {
            $upload = upload_gambar('profile', 'Foto', $id);
            if ($upload != 'error') {
                $foto = $upload;
            }
        }
        $data = [
            'name' => $this->input->post('Nama'),
            'password' => $password,
            'image' => $foto,
        ];
        $this->UserModel->update($id, $data);
        $data_plg = [
            'nama' => $this->input->post('Nama'),
            'no_telp' => $this->input->post('Telepon'),
            'alamat' => $this->input->post('Alamat'),
            'kode_pos' => $this->input->post('KodePos'),
            'kota' => $this->input->post('Kota'),
            'provinsi' => $this->input->post('Provinsi'),
        ];
        $this->PelangganModel->update($id, $data_plg);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Profil berhasil diupdate.</div>');
        redirect(base_url('profile'));
    }

    public function pesanan($id)
    {
        $data['user'] = $this->loggedUser;
        $this->db->where('id', $this->loggedUser['role_id']);
        $data['r_now'] = $this->db->get('user_role')->row_array();
        $data['modelTitle'] = 'Pesanan';
        $data['title'] = 'Detail Pesanan ' . $id;
        $data['keranjang'] = $this->KeranjangModel->get_by_user($data['user']['id']);
        $data['pesanan'] = $this->PesanModel->get_by_id($id);
        $data['detail'] = $this->PesanModel->get_detail($id);
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['pembayaran'] = $this->db->get('tbl_pembayaran')->result_array();
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('profile/pesanan_detail', $data);
        $this->load->view('tamplates/footer');
    }
}
