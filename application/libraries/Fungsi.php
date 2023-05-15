<?php

Class Fungsi {
    protected $ci;
    function __construct() {
        $this->ci =& get_instance();
    }

    function user_login() {
        $this->ci->load->model('m_data');
        $user_id = $this->ci->session->userdata('id');
        $user_data = $this->ci->m_data->user($user_id)->row();
        return $user_data;
    }

    public function penetapan() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->penetapan()->num_rows();
    }
    
    public function pelaksanaan() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->pelaksanaan()->num_rows();
    }

    public function evaluasi() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->evaluasi()->num_rows();
    }

    public function pengendalian() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->pengendalian()->num_rows();
    }

    public function peningkatan() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->peningkatan()->num_rows();
    }

    public function pengaturan() {
        $this->ci->load->model('m_data');
        return $this->ci->m_data->pengaturan()->row();
    }
}