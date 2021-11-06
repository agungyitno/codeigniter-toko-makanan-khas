<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PesanModel extends CI_Model
{
    public $tabel = 'tbl_pesanan';
    public $id = 'id_pesanan';
    public $order = 'DESC';

    function total_rows()
    {
        return $this->db->get($this->tabel)->num_rows();
    }

    function total_rows_by_user($id_user)
    {
        $this->db->where('user_id', $id_user);
        return $this->db->get($this->tabel)->num_rows();
    }

    function total_rows_by_state($state)
    {
        $this->db->where('status', $state);
        return $this->db->get($this->tabel)->num_rows();
    }
    public function cek_id_pesan()
    {
        $this->db->select_max('id_pesanan');
        $query = $this->db->get($this->tabel)->row();
        return $query->id_pesanan;
    }

    function get_all()
    {
        $this->db->join('user', 'user.id = tbl_pesanan.user_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_user($id_user)
    {
        $this->db->where('user_id', $id_user);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_state_and_user($state, $id_user)
    {
        $this->db->where('user_id', $id_user);
        $this->db->where('status', $state);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_detail($id)
    {
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_pesanan_detail.produk_id');
        $this->db->where('pesanan_id', $id);
        return $this->db->get('tbl_pesanan_detail')->result_array();
    }

    public function get_bukti_by_id($id)
    {
        $this->db->join('user', 'tbl_konfirmasi.user_id = user.id', 'left');
        $this->db->join('tbl_pesanan', 'tbl_konfirmasi.pesanan_id = tbl_pesanan.id_pesanan', 'left');
        $this->db->where('id_konfirmasi', $id);
        return $this->db->get('tbl_konfirmasi')->row();
    }

    public function get_bukti_by_pesanan($id)
    {
        $this->db->join('user', 'tbl_konfirmasi.user_id = user.id', 'left');
        $this->db->join('tbl_pesanan', 'tbl_konfirmasi.pesanan_id = tbl_pesanan.id_pesanan', 'left');
        $this->db->where('pesanan_id', $id);
        $this->db->order_by('id_konfirmasi', 'DESC');
        return $this->db->get('tbl_konfirmasi')->row();
    }

    function get_by_id($id)
    {
        $this->db->join('user', 'user.id = tbl_pesanan.user_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->tabel)->row();
    }

    function insert($data)
    {
        $this->db->insert($this->tabel, $data);
    }
    function insert_detail($data)
    {
        $this->db->insert('tbl_pesanan_detail', $data);
    }
    function insert_bukti($data)
    {
        $this->db->insert('tbl_konfirmasi', $data);
    }
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->tabel, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->tabel);
    }
}
