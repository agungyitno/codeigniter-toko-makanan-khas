<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SatuanModel extends CI_Model
{
    public $tabel = 'tbl_satuan';
    public $id = 'id_satuan';
    public $order = 'DESC';

    function total_rows()
    {
        return $this->db->get($this->tabel)->num_rows();
    }

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_limit($limit, $offset)
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel, $limit, $offset)->result_array();
    }
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->tabel)->row();
    }

    function get_by_search($q)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->or_like('nama_satuan', $q);
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
