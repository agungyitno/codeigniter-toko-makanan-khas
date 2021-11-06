<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public $tabel = 'user';
    public $id = 'id';
    public $order = 'DESC';

    function total_rows()
    {
        return $this->db->get($this->tabel)->num_rows();
    }

    function get_all()
    {
        $this->db->order_by('is_active', $this->order);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_role($role)
    {
        if ($role == 2) {
            $this->db->join('tbl_pelanggan', 'user.id = tbl_pelanggan.user_id');
        }
        $this->db->where('role_id', $role);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->tabel)->result_array();
    }

    function get_by_state($state)
    {
        $this->db->where('is_active', $state);
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
