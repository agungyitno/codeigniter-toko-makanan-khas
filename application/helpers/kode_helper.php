<?php
function isLogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Silahkan Login untuk melanjutkan.</div>');
        redirect('auth');
    } else {
        $modul = $ci->uri->segment(1);
        $user = $ci->db->get_where('user', ['email' => $ci->session->userdata('email')])->row_array();
        $role_id = $user['role_id'];
        $menu = $ci->db->get_where('user_sub_menu', ['url' => $modul])->row_array();
        $menu_id = $menu['id'];
        $hak_akses = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);
        if ($hak_akses->num_rows() < 1) {
            redirect('blokir');
            exit;
        }
    }
}

function upload_gambar($jenis, $input, $id)
{
    $ci = get_instance();
    $config['upload_path']          = './assets/img/' . $jenis . '/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 4000;
    $config['max_width']            = 3000;
    $config['max_height']           = 3000;
    $config['file_name']           = 'img_' . $jenis . '_' . $id;
    $config['overwrite'] = TRUE;
    $ci->load->library('upload', $config);
    if ($ci->upload->do_upload($input)) {
        return $ci->upload->data('file_name');
    } else {
        return 'error';
    }
}

function cek_expired()
{
    $ci = get_instance();
    $ci->db->where('status', 'Belum Bayar');
    $ci->db->where('batas_pembayaran <', time());
    $get_exp = $ci->db->get('tbl_pesanan')->result_array();
    if (count($get_exp) > 0) {
        foreach ($get_exp as $ex) {
            $ci->db->where('pesanan_id', $ex['id_pesanan']);
            $ci->db->delete('tbl_pesanan_detail');
            $ci->db->where('id_pesanan', $ex['id_pesanan']);
            $ci->db->delete('tbl_pesanan');
        }
    }
}
