<?php

// WWW.MALASNGODING.COM === Author : Diki Alfarabi Hadi
// Model yang terstruktur. agar bisa digunakan berulang kali untuk membuat CRUD. 
// Sehingga proses pembuatan CRUD menjadi lebih cepat dan efisien.

class M_data extends CI_Model
{

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    // FUNGSI CRUD
    // fungsi untuk mengambil data dari database
    function get_data($table)
    {
        return $this->db->get($table);
    }

    // fungsi untuk menginput data ke database
    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function insert_gal($data = array())
    {
        $this->db->insert_batch('gallery_satker', $data);
    }

    // fungsi untuk mengedit data
    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function pengaturan()
    {
        $this->db->from('pengaturan');
        $query = $this->db->get('logo');
        return $query;
    }

    public function penetapan()
    {
        $this->db->from('penetapan');
        $this->db->where('penetapan_status = "Belum Terverifikasi"');
        $query = $this->db->get();
        return $query;
    }
    public function pelaksanaan()
    {
        $this->db->from('pelaksanaan');
        $this->db->where('pelaksanaan_status = "Belum Terverifikasi"');
        $query = $this->db->get();
        return $query;
    }
    public function evaluasi()
    {
        $this->db->from('evaluasi');
        $this->db->where('evaluasi_status = "Belum Terverifikasi"');
        $query = $this->db->get();
        return $query;
    }
    public function pengendalian()
    {
        $this->db->from('pengendalian');
        $this->db->where('pengendalian_status = "Belum Terverifikasi"');
        $query = $this->db->get();
        return $query;
    }
    public function peningkatan()
    {
        $this->db->from('peningkatan');
        $this->db->where('peningkatan_status = "Belum Terverifikasi"');
        $query = $this->db->get();
        return $query;
    }

    public function user($id = null)
    {
        $this->db->from('pengguna');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    // fungsi untuk mengupdate atau mengubah data di database
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    // fungsi untuk menghapus data dari database
    function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }
    // AKHIR FUNGSI CRUD


}
