<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class KeranjangModel extends CI_Model
{
    public $tabel = 'tbl_keranjang';
    public $id = 'id_keranjang';
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

    function get_all()
    {
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_keranjang.produk_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_user($id_user)
    {
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_keranjang.produk_id');
        $this->db->where('user_id', $id_user);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_produk($id_user, $produk)
    {
        $this->db->join('tbl_produk', 'tbl_produk.id_produk = tbl_keranjang.produk_id');
        $this->db->where('user_id', $id_user);
        $this->db->where('produk_id', $produk);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->row();
    }

    function insert($data)
    {
        $this->db->insert($this->tabel, $data);
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
