<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ProdukModel');
        $this->load->model('KategoriModel');
        $this->load->model('KeranjangModel');
        $this->load->model('SatuanModel');
        $this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
    public function index()
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Produk';
        $data['title'] = 'Toko Makanan Khas';
        if ($this->loggedUser != null) {
            $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        } else {
            $data['totalCart'] =  0;
        }
        $jumlah_data = $this->ProdukModel->total_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url('produk/index/');
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;
        $config['first_link']       = '<<';
        $config['last_link']        = '>>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['produk'] = $this->ProdukModel->get_limit($config['per_page'], $from);
        $data['kategori'] = $this->KategoriModel->get_all();
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('produk', $data);
        $this->load->view('tamplates/footer');
    }

    public function lihat($id)
    {
        $data['title'] = 'Detail Produk';
        $data['produk'] = $this->ProdukModel->get_by_id($id);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['satuan'] = $this->SatuanModel->get_all();
        if ($this->loggedUser != null) {
            $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        } else {
            $data['totalCart'] =  0;
        }
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('detail_produk', $data);
        $this->load->view('tamplates/footer');
    }
    public function kategori($url = null)
    {
        if (empty($url)) {
            redirect('produk');
        }
        $this->db->where('nama_kategori', urldecode($url));
        $query = $this->db->get('tbl_kategori')->row();
        $id = $query->id_kategori;
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Produk';
        $jumlah_data = $this->ProdukModel->total_rows_by('kategori_id', $id);
        $this->load->library('pagination');
        $config['base_url'] = base_url('produk/kategori/') . $url;
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;
        $config['first_link']       = '<<';
        $config['last_link']        = '>>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data['produk'] = $this->ProdukModel->get_by_and_limit('kategori_id', $id, $config['per_page'], $from);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['kategori_pilih'] = $this->KategoriModel->get_by_id($id);
        $data['title'] = 'Kategori Produk ' . $data['kategori_pilih']->nama_kategori;
        if ($this->loggedUser != null) {
            $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        } else {
            $data['totalCart'] =  0;
        }
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('produk', $data);
        $this->load->view('tamplates/footer');
    }

    public function cari($q)
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Produk';
        $jumlah_data = $this->ProdukModel->total_rows_search($q);
        $this->load->library('pagination');
        $config['base_url'] = base_url('produk/cari/') . $q;
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 12;
        $config['first_link']       = '<<';
        $config['last_link']        = '>>';
        $config['next_link']        = '>';
        $config['prev_link']        = '<';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $data['produk'] = $this->ProdukModel->get_by_search_and_limit($q, $config['per_page'], $from);
        $data['kategori'] = $this->KategoriModel->get_all();
        $data['cari_pilih'] = urldecode($q);
        $data['title'] = 'Pencarian Produk ' . $data['cari_pilih'];
        $data['totalCart'] =  $this->KeranjangModel->total_rows_by_user($this->loggedUser['id']);
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/home_topbar', $data);
        $this->load->view('produk', $data);
        $this->load->view('tamplates/footer');
    }

    public function aksi_cari()
    {
        $q = $this->input->get('cari');
        redirect(base_url('produk/cari/') . $q);
    }
}
