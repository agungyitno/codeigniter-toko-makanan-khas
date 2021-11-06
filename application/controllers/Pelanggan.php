<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('PelangganModel');
        $this->loggedUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data['user'] = $this->loggedUser;
        $data['modelTitle'] = 'Pelanggan';
        $data['title'] = 'Data Pelanggan';
        $data['pelanggan'] = $this->PelangganModel->get_by_state(1);
        $this->load->view('tamplates/header', $data);
        $this->load->view('tamplates/sidebar', $data);
        $this->load->view('tamplates/topbar', $data);
        $this->load->view('admin/pelanggan', $data);
        $this->load->view('tamplates/footer');
    }

    public function update_password()
    {
        $id = $this->input->post('id');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data = [
            'password' => $password,
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Password berhasil berhasil diupdate.</div>');
        redirect(base_url('pelanggan'));
    }

    public function nonaktifkan()
    {
        $id = $this->input->post('id');
        $state = $this->input->post('id');
        $data = [
            'is_active' => $state,
        ];
    }
}
