<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PembayaranModel extends CI_Model
{
    public $tabel = 'tbl_konfirmasi';
    public $id = 'id_konfirmasi';
    public $order = 'DESC';

    function total_rows()
    {
        return $this->db->get($this->tabel)->num_rows();
    }

    function get_rekening()
    {
        $this->db->order_by('id_pembayaran', $this->order);
        return $this->db->get('tbl_pembayaran')->result_array();
    }

    function insert_rekening($data)
    {
        $this->db->insert('tbl_pembayaran', $data);
    }
    function update_rekening($id, $data)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->update('tbl_pembayaran', $data);
    }
    function delete_rekening($id)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->delete('tbl_pembayaran');
    }

    function get_all()
    {
        $this->db->join('user', 'user.id = tbl_konfirmasi.user_id');
        $this->db->join('tbl_pesanan', 'tbl_pesanan.id_pesanan = tbl_konfirmasi.pesanan_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_limit($limit, $offset)
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel, $limit, $offset)->result_array();
    }

    function get_by($kolom, $value)
    {
        $this->db->where($kolom, $value);
        return $this->db->get($this->tabel)->result_array();
    }
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->tabel)->row();
    }

    function get_by_search($q)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->or_like('nama_kategori', $q);
        return $this->db->get($this->tabel)->result_array();
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
