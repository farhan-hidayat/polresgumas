<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_data');
		$this->load->library('form_validation');
	}

	public function index()
	{
		check_already_login();
		$this->load->view('v_login');
	}

	public function daftar()
	{
		$data['fakultas'] = $this->m_data->get_data('fakultas')->result();
		$this->load->view('v_daftar', $data);
	}

	public function get_prodi()
	{
		$fakultas_id = $this->input->post('fakultas_id');
		$data = $this->db->query("SELECT * FROM prodi WHERE fakultas=$fakultas_id order by prodi_id desc")->result();
		echo json_encode($data);
	}

	public function daftar_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
		$this->form_validation->set_rules('email', 'Email Pengguna', 'required|is_unique[pengguna.email]');
		$this->form_validation->set_rules('username', 'Username Pengguna', 'required|is_unique[pengguna.username]');
		$this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
		$this->form_validation->set_rules(
			'passconf',
			'Konfirmasi Password',
			'required|matches[password]',
			array('matches' => '%s Tidak Sesuai dengan Password')
		);
		$this->form_validation->set_rules('fakultas', 'Fakultas', 'required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$fakultas = $this->input->post('fakultas');
			$prodi = $this->input->post('prodi');
			$level = 'auditee';
			$status = '1';

			$data = array(
				'nama' => $nama,
				'email' => $email,
				'username' => $username,
				'password' => $password,
				'level' => $level,
				'fakultas' => $fakultas,
				'prodi' => $prodi,
				'level' => $level,
				'status' => $status
			);


			$this->m_data->insert_data($data, 'pengguna');

			redirect(base_url() . 'login');
		} else {
			$data['fakultas'] = $this->m_data->get_data('fakultas')->result();
			$this->load->view('v_daftar', $data);
		}
	}

	public function aksi()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() != false) {

			// menangkap data username dan password dari halaman login
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => md5($password),
				'status' => 1
			);

			$this->load->model('m_data');

			// cek kesesuaian login pada table pengguna
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			// cek jika login benar
			if ($cek > 0) {

				// ambil data pengguna yang melakukan login
				$data = $this->m_data->cek_login('pengguna', $where)->row();

				// buat session untuk pengguna yang berhasil login
				$data_session = array(
					'id' => $data->id,
					'username' => $data->username,
					'nama' => $data->nama,
					'level' => $data->level,
					'status' => 'telah_login'
				);
				$this->session->set_userdata($data_session);

				// alihkan halaman ke halaman dashboard pengguna

				redirect(base_url() . 'dashboard');
			} else {
				redirect(base_url() . 'login?alert=gagal');
			}
		} else {
			$this->load->view('v_login');
		}
	}
}
