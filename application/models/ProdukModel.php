<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProdukModel extends CI_Model
{
    public $tabel = 'tbl_produk';
    public $id = 'id_produk';
    public $order = 'DESC';

    function total_rows()
    {
        return $this->db->get($this->tabel)->num_rows();
    }
    function total_rows_by($kolom, $value)
    {
        $this->db->where($kolom, $value);
        return $this->db->get($this->tabel)->num_rows();
    }

    function get_all()
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_limit($limit, $offset)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel, $limit, $offset)->result_array();
    }

    function get_by_and_limit($kolom, $value, $limit, $offset)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->where($kolom, $value);
        return $this->db->get($this->tabel, $limit, $offset)->result_array();
    }
    function get_by($kolom, $value)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->where($kolom, $value);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_id($id)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->where($this->id, $id);
        return $this->db->get($this->tabel)->row();
    }

    function get_by_search($q)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_produk', $q);
        return $this->db->get($this->tabel)->result_array();
    }

    function total_rows_search($q)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_produk', $q);
        return $this->db->get($this->tabel)->num_rows();
    }

    function get_by_search_and_limit($q, $limit, $offset)
    {
        $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_produk.kategori_id');
        $this->db->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.satuan_id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('nama_produk', $q);
        return $this->db->get($this->tabel, $limit, $offset)->result_array();
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
