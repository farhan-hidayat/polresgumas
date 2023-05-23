<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		check_not_login();
		check_admin();
		$this->load->model('m_data');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function index()
	{
		// hitung jumlah berita
		$data['jumlah_berita'] = $this->m_data->get_data('berita')->num_rows();
		// // hitung jumlah kategori
		$data['jumlah_kategori'] = $this->m_data->get_data('kategori')->num_rows();
		// // hitung jumlah pengguna
		$data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();
		// // hitung jumlah halaman
		$data['jumlah_pengaduan'] = $this->m_data->get_data('pengaduan')->num_rows();


		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/v_index', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		// cek validasi
		if ($this->form_validation->run() != false) {

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
			$where = array(
				'id' => $this->session->userdata('id'),
				'password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			// cek kesesuaikan password lama
			if ($cek > 0) {

				// update data password pengguna
				$w = array(
					'id' => $this->session->userdata('id')
				);
				$data = array(
					'password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'pengguna');

				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			} else {
				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	// CRUD KATEGORI
	public function kategori()
	{
		$data = array(
			'kategori' => $this->m_data->get_data('kategori')->result()
		);
		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/kategori/v_kategori', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function kategori_tambah()
	{
		$data = array();
		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/kategori/v_kategori_tambah');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function kategori_aksi()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('ket', 'Ket', 'required');

		if ($this->form_validation->run() != false) {

			$kategori = $this->input->post('kategori');
			$ket = $this->input->post('ket');

			$data = array(
				'nama_kategori' => $kategori,
				'ket_kategori' => $ket,
				'slug_kategori' => strtolower(
					url_title($kategori)
				)
			);

			$this->m_data->insert_data($data, 'kategori');

			redirect(base_url() . 'dashboard/kategori/kategori');
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/kategori/v_kategori_tambah');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function kategori_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/kategori/v_kategori_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function kategori_update()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('ket', 'Ket', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');
			$ket = $this->input->post('ket');

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama_kategori' => $kategori,
				'ket_kategori' => $ket,
				'slug_kategori' => strtolower(url_title($kategori))
			);

			$this->m_data->update_data($where, $data, 'kategori');

			redirect(base_url() . 'dashboard/kategori/kategori');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kategori_id' => $id
			);
			$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/kategori/v_kategori_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function kategori_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$this->m_data->delete_data($where, 'kategori');

		redirect(base_url() . 'dashboard/kategori/kategori');
	}
	// END CRUD KATEGORI

	// CRUD KATEGORI
	public function aplikasi()
	{
		$data['aplikasi'] = $this->db->query("SELECT aplikasi.id as app, nama_aplikasi, slug_aplikasi, link_aplikasi,nama_kategori FROM aplikasi,kategori WHERE kategori_aplikasi=kategori.id order by aplikasi.id desc")->result();
		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/aplikasi/v_aplikasi', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function aplikasi_tambah()
	{
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Aplikasi' order by id desc")->result();

		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/aplikasi/v_aplikasi_tambah');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function aplikasi_aksi()
	{
		$this->form_validation->set_rules('aplikasi', 'aplikasi', 'required');
		$this->form_validation->set_rules('link', 'link', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');

		if ($this->form_validation->run() != false) {

			$aplikasi = $this->input->post('aplikasi');
			$kategori = $this->input->post('kategori');
			$ket = $this->input->post('ket');
			$link = $this->input->post('link');

			$data = array(
				'nama_aplikasi' => $aplikasi,
				'kategori_aplikasi' => $kategori,
				'link_aplikasi' => $link,
				'slug_aplikasi' => strtolower(
					url_title($aplikasi)
				)
			);

			$this->m_data->insert_data($data, 'aplikasi');

			redirect(base_url() . 'dashboard/aplikasi/aplikasi');
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/aplikasi/v_aplikasi_tambah');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function aplikasi_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['aplikasi'] = $this->m_data->edit_data($where, 'aplikasi')->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Aplikasi' order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/aplikasi/v_aplikasi_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function aplikasi_update()
	{
		$this->form_validation->set_rules('aplikasi', 'aplikasi', 'required');
		$this->form_validation->set_rules('link', 'link', 'required');
		$this->form_validation->set_rules('kategori', 'kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$aplikasi = $this->input->post('aplikasi');
			$kategori = $this->input->post('kategori');
			$ket = $this->input->post('ket');
			$link = $this->input->post('link');

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama_aplikasi' => $aplikasi,
				'kategori_aplikasi' => $kategori,
				'link_aplikasi' => $link,
				'slug_aplikasi' => strtolower(url_title($aplikasi))
			);

			$this->m_data->update_data($where, $data, 'aplikasi');

			redirect(base_url() . 'dashboard/aplikasi/aplikasi');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'aplikasi_id' => $id
			);
			$data['aplikasi'] = $this->m_data->edit_data($where, 'aplikasi')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/aplikasi/v_aplikasi_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function aplikasi_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$this->m_data->delete_data($where, 'aplikasi');

		redirect(base_url() . 'dashboard/aplikasi/aplikasi');
	}
	// END CRUD KATEGORI

	// CRUD pengaduan
	public function pengaduan()
	{
		$data = array(
			'pengaduan' => $this->m_data->get_data('pengaduan')->result()
		);
		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/pengaduan/v_pengaduan', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function pengaduan_balas($id)
	{
		$where = array(
			'id' => $id
		);
		$data['pengaduan'] = $this->m_data->edit_data($where, 'pengaduan')->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/pengaduan/v_pengaduan_balas', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function pengaduan_kirim()
	{
		$this->form_validation->set_rules('subject', 'subject', 'required');
		$this->form_validation->set_rules('pesan', 'pesan', 'required');

		if ($this->form_validation->run() != false) {

			$config = array(
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_user' => 'farhanarchman@gmail.com',  // Email gmail
				'smtp_pass'   => 'ureygajnkgathwnz',  // Password gmail
				'smtp_port'   => 465,
				'smtp_timeout' => 5,
				'newline' => "\r\n"
			);

			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$pesan = $this->input->post('pesan');
			$subject = $this->input->post('subject');
			$tgl = date('Y-m-d H:i:s');

			$where = array(
				'id' => $id
			);

			$data = array(
				'balasan_pengaduan' => $pesan,
				'tanggal_balasan' => $tgl,
				'status_pengaduan' => 'Sudah',
			);

			$this->m_data->update_data($where, $data, 'pengaduan');

			// $this->load->library('email', $config);
			$this->email->initialize($config);
			$this->email->from($config['smtp_user']);
			$this->email->to($email); //email penerima
			$this->email->subject($subject); //subjek email
			$this->email->message($pesan);

			if ($this->email->send()) {
				echo 'Sukses! email berhasil dikirim.';
				redirect(base_url() . 'dashboard/pengaduan/pengaduan');
			} else {
				echo 'Error! email tidak dapat dikirim.';
				$id = $this->input->post('id');
				$where = array(
					'id' => $id
				);
				$data['pengaduan'] = $this->m_data->edit_data($where, 'pengaduan')->result();
				$this->load->view('dashboard/layout/v_header');
				$this->load->view('dashboard/pengaduan/v_pengaduan_balas', $data);
				$this->load->view('dashboard/layout/v_footer');
			}
		} else {

			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['pengaduan'] = $this->m_data->edit_data($where, 'pengaduan')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/pengaduan/v_pengaduan_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function pengaduan_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$this->m_data->delete_data($where, 'pengaduan');

		redirect(base_url() . 'dashboard/pengaduan/pengaduan');
	}
	// END CRUD pengaduan


	// CRUD BERITA
	public function berita()
	{
		$data['berita'] = $this->db->query("SELECT berita.id as berita, tanggal_berita, judul_berita, slug_berita, nama, nama_kategori, sampul_berita, status_berita FROM berita,kategori,pengguna WHERE kategori_berita=kategori.id and pengguna_berita=pengguna.id order by berita.id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/berita/v_berita', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function berita_tambah()
	{
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Berita' order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/berita/v_berita_tambah', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function berita_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[berita.judul_berita]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/berita/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug = strtolower(url_title($judul));
				$konten = $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'tanggal_berita' => $tanggal,
					'judul_berita' => $judul,
					'slug_berita' => $slug,
					'konten_berita' => $konten,
					'sampul_berita' => $sampul,
					'pengguna_berita' => $author,
					'kategori_berita' => $kategori,
					'status_berita' => $status,
				);

				$this->m_data->insert_data($data, 'berita');

				redirect(base_url() . 'dashboard/berita/berita');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='Berita' order by kategori_id desc")->result();
				$this->load->view('dashboard/layout/v_header');
				$this->load->view('dashboard/berita/v_berita_tambah', $data);
				$this->load->view('dashboard/layout/v_footer');
			}
		} else {
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Berita' order by id desc")->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/berita/v_berita_tambah', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function berita_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['berita'] = $this->m_data->edit_data($where, 'berita')->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Berita' order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/berita/v_berita_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function berita_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'id' => $id
			);

			$data = array(
				'judul_berita' => $judul,
				'slug_berita' => $slug,
				'konten_berita' => $konten,
				'kategori_berita' => $kategori,
				'status_berita' => $status,
			);

			$this->m_data->update_data($where, $data, 'berita');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/berita/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'sampul_berita' => $gambar['file_name'],
					);

					$a = $this->m_data->edit_data($where, 'berita')->row();
					$target_file = './gambar/berita/' . $a->sampul_berita;
					unlink($target_file);

					$this->m_data->update_data($where, $data, 'berita');

					redirect(base_url() . 'dashboard/berita');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'id' => $id
					);
					$data['berita'] = $this->m_data->edit_data($where, 'berita')->result();
					$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='Berita' order by kategori_id desc")->result();
					$this->load->view('dashboard/layout/v_header');
					$this->load->view('dashboard/berita/v_berita_edit', $data);
					$this->load->view('dashboard/layout/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/berita/berita');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['berita'] = $this->m_data->edit_data($where, 'berita')->result();
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Berita' order by id desc")->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/berita/v_berita_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function berita_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$a = $this->m_data->edit_data($where, 'berita')->row();
		$target_file = './gambar/berita/' . $a->sampul_berita;
		unlink($target_file);

		$this->m_data->delete_data($where, 'berita');

		redirect(base_url() . 'dashboard/berita/berita');
	}
	// end crud berita

	// CRUD polsek
	public function polsek()
	{
		$data['polsek'] = $this->db->query("SELECT * FROM polsek order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/polsek/v_polsek', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function polsek_tambah()
	{
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/polsek/v_polsek_tambah');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function polsek_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('nama', 'nama', 'required|is_unique[polsek.nama_polsek]');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/polsek/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$nama = $this->input->post('nama');
				$slug = strtolower(url_title($nama));
				$sampul = $gambar['file_name'];
				$alamat = $this->input->post('alamat');
				$map = $this->input->post('map');

				$data = array(
					'nama_polsek' => $nama,
					'slug_polsek' => $slug,
					'sampul_polsek' => $sampul,
					'alamat_polsek' => $alamat,
					'map_polsek' => $map,
				);

				$this->m_data->insert_data($data, 'polsek');

				redirect(base_url() . 'dashboard/polsek/polsek');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$this->load->view('dashboard/layout/v_header');
				$this->load->view('dashboard/polsek/v_polsek_tambah', $data);
				$this->load->view('dashboard/layout/v_footer');
			}
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/polsek/v_polsek_tambah');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function polsek_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['polsek'] = $this->m_data->edit_data($where, 'polsek')->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/polsek/v_polsek_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function polsek_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$slug = strtolower(url_title($nama));
			$alamat = $this->input->post('alamat');
			$map = $this->input->post('map');

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama_polsek' => $nama,
				'slug_polsek' => $slug,
				'alamat_polsek' => $alamat,
				'map_polsek' => $map,
			);

			$this->m_data->update_data($where, $data, 'polsek');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/polsek/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'sampul_polsek' => $gambar['file_name'],
					);

					$a = $this->m_data->edit_data($where, 'polsek')->row();
					$target_file = './gambar/polsek/' . $a->polsek_sampul;
					unlink($target_file);

					$this->m_data->update_data($where, $data, 'polsek');

					redirect(base_url() . 'dashboard/polsek');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'id' => $id
					);
					$data['polsek'] = $this->m_data->edit_data($where, 'polsek')->result();
					$this->load->view('dashboard/layout/v_header');
					$this->load->view('dashboard/polsek/v_polsek_edit', $data);
					$this->load->view('dashboard/layout/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/polsek/polsek');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['polsek'] = $this->m_data->edit_data($where, 'polsek')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/polsek/v_polsek_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function polsek_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$a = $this->m_data->edit_data($where, 'polsek')->row();
		$target_file = './gambar/polsek/' . $a->sampul_polsek;
		unlink($target_file);

		$this->m_data->delete_data($where, 'polsek');

		redirect(base_url() . 'dashboard/polsek/polsek');
	}
	// end crud polsek

	// CRUD satker
	public function satker()
	{
		$data['satker'] = $this->db->query("SELECT * FROM satker order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/satker/v_satker', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function satker_tambah()
	{
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/satker/v_satker_tambah');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function satker_aksi()
	{
		$data = array();
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('nama', 'nama', 'required|is_unique[satker.nama_satker]');
		$this->form_validation->set_rules('ket', 'ket', 'required');


		if ($this->form_validation->run() != false) {

			$count = count($_FILES['files']['name']);
			$nama = $this->input->post('nama');
			$slug = strtolower(url_title($nama));
			$ket = $this->input->post('ket');

			$dataSatker = array(
				'nama_satker' => $nama,
				'slug_satker' => $slug,
				'ket_satker' => $ket,
			);

			$this->m_data->insert_data($dataSatker, 'satker');
			$idsatker = $this->db->query("SELECT id FROM satker order by id desc limit 1")->row('id');

			for ($i = 0; $i < $count; $i++) {
				if (!empty($_FILES['files']['name'][$i])) {
					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path']   = './gambar/satker/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file')) {

						$gambar = $this->upload->data();
						// $nama = $this->input->post('nama');
						// $slug = strtolower(url_title($nama));
						// $ket = $this->input->post('ket');

						// $data = array(
						// 	'nama_satker' => $nama,
						// 	'slug_satker' => $slug,
						// 	'ket_satker' => $ket,
						// );

						// $this->m_data->insert_data($data, 'satker');

						// mengambil data tentang gambar
						$data1['satker'] = $idsatker;
						$data1['foto_satker'] = $gambar['file_name'];
						$this->db->insert('gallery_satker', $data1);

						// redirect(base_url() . 'dashboard/satker/satker');
					} else {
						// $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

						// $this->load->view('dashboard/layout/v_header');
						// $this->load->view('dashboard/satker/v_satker_tambah', $data);
						// $this->load->view('dashboard/layout/v_footer');

						$data['gambar_error'][] = $this->upload->display_errors();
					}
				}
				if ($i == $count - 1) {
					if (empty($data['gambar_error'])) {
						redirect(base_url() . 'dashboard/satker/satker');
					}

					// ni gatau, soalnya gambar_error sdh jd array 
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$this->load->view('dashboard/layout/v_header');
					$this->load->view('dashboard/satker/v_satker_tambah', $data);
					$this->load->view('dashboard/layout/v_footer');
				}
			}
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/satker/v_satker_tambah');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function satker_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['satker'] = $this->m_data->edit_data($where, 'satker')->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/satker/v_satker_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function satker_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('ket', 'ket', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$slug = strtolower(url_title($nama));
			$ket = $this->input->post('ket');

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama_satker' => $nama,
				'slug_satker' => $slug,
				'ket_satker' => $ket,
			);

			$this->m_data->update_data($where, $data, 'satker');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/satker/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'sampul_satker' => $gambar['file_name'],
					);

					$a = $this->m_data->edit_data($where, 'satker')->row();
					$target_file = './gambar/satker/' . $a->satker_sampul;
					unlink($target_file);

					$this->m_data->update_data($where, $data, 'satker');

					redirect(base_url() . 'dashboard/satker');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'id' => $id
					);
					$data['satker'] = $this->m_data->edit_data($where, 'satker')->result();
					$this->load->view('dashboard/layout/v_header');
					$this->load->view('dashboard/satker/v_satker_edit', $data);
					$this->load->view('dashboard/layout/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/satker/satker');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['satker'] = $this->m_data->edit_data($where, 'satker')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/satker/v_satker_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function satker_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$a = $this->m_data->edit_data($where, 'satker')->row();
		$target_file = './gambar/satker/' . $a->sampul_satker;
		unlink($target_file);

		$this->m_data->delete_data($where, 'satker');

		redirect(base_url() . 'dashboard/satker/satker');
	}
	// end crud satker

	// CRUD GALLERY
	public function gallery()
	{
		$data['gallery'] = $this->db->query("SELECT gallery.id as gal, tanggal_gallery, judul_gallery, nama, nama_kategori, sampul_gallery, status_gallery FROM gallery,kategori,pengguna WHERE kategori_gallery=kategori.id and pengguna_gallery=pengguna.id order by gallery.id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/gallery/v_gallery', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function gallery_tambah()
	{
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Galeri' order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/gallery/v_gallery_tambah', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function gallery_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[gallery.judul_gallery]');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/gallery/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'tanggal_gallery' => $tanggal,
					'judul_gallery' => $judul,
					'sampul_gallery' => $sampul,
					'pengguna_gallery' => $author,
					'kategori_gallery' => $kategori,
					'status_gallery' => $status,
				);

				$this->m_data->insert_data($data, 'gallery');

				redirect(base_url() . 'dashboard/gallery');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
				$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='Galeri' order by kategori_id desc")->result();
				$this->load->view('dashboard/layout/v_header');
				$this->load->view('dashboard/gallery/v_gallery_tambah', $data);
				$this->load->view('dashboard/layout/v_footer');
			}
		} else {
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='Galeri' order by kategori_id desc")->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/gallery/v_gallery_tambah', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}


	public function gallery_edit($id)
	{
		$where = array(
			'id' => $id
		);
		$data['gallery'] = $this->m_data->edit_data($where, 'gallery')->result();
		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Galeri' order by id desc")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/gallery/v_gallery_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}


	public function gallery_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'id' => $id
			);

			$data = array(
				'judul_gallery' => $judul,
				'kategori_gallery' => $kategori,
				'status_gallery' => $status,
			);

			$this->m_data->update_data($where, $data, 'gallery');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/gallery/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'sampul_gallery' => $gambar['file_name'],
					);

					$a = $this->m_data->edit_data($where, 'gallery')->row();
					$target_file = './gambar/gallery/' . $a->sampul;
					unlink($target_file);

					$this->m_data->update_data($where, $data, 'gallery');

					redirect(base_url() . 'dashboard/gallery');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'id' => $id
					);
					$data['gallery'] = $this->m_data->edit_data($where, 'gallery')->result();
					$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Galeri' order by kategori_id desc")->result();
					$this->load->view('dashboard/layout/v_header');
					$this->load->view('dashboard/gallery/v_gallery_edit', $data);
					$this->load->view('dashboard/layout/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/gallery');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['gallery'] = $this->m_data->edit_data($where, 'gallery')->result();
			$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori='Galeri' order by kategori_id desc")->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/gallery/v_gallery_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function gallery_hapus($id)
	{
		$where = array(
			'id' => $id
		);

		$a = $this->m_data->edit_data($where, 'gallery')->row();
		$target_file = './gambar/gallery/' . $a->sampul;
		unlink($target_file);
		// var_dump($a);
		$this->m_data->delete_data($where, 'gallery');

		redirect(base_url() . 'dashboard/gallery/gallery');
	}
	// end crud gallery



	public function profil()
	{
		// id pengguna yang sedang login
		$id_pengguna = $this->session->userdata('id');

		$where = array(
			'id' => $id_pengguna
		);

		$data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/v_profil', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->session->userdata('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');

			$where = array(
				'id' => $id
			);

			$data = array(
				'nama' => $nama,
				'email' => $email
			);

			$this->m_data->update_data($where, $data, 'pengguna');

			redirect(base_url() . 'dashboard/profil/?alert=sukses');
		} else {
			// id pengguna yang sedang login
			$id_pengguna = $this->session->userdata('id');

			$where = array(
				'id' => $id_pengguna
			);

			$data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/v_profil', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}


	public function pengaturan()
	{
		// check_admin();
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
		$this->load->view('dashboard/layout/v_header', $data);
		$this->load->view('dashboard/v_pengaturan', $data);
		$this->load->view('dashboard/layout/v_footer');
	}


	public function pengaturan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama', 'Nama Website', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Website', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$link_fb = $this->input->post('link_fb');
			$link_tw = $this->input->post('link_tw');
			$link_ig = $this->input->post('link_ig');
			$link_yt = $this->input->post('link_yt');
			$visi = $this->input->post('visi');
			$tugas = $this->input->post('tugas');

			$where = array();

			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'link_fb' => $link_fb,
				'link_tw' => $link_tw,
				'link_ig' => $link_ig,
				'link_yt' => $link_yt,
				'visi' => $visi,
				'tugas' => $tugas,
			);

			// update pengaturan
			$this->m_data->update_data($where, $data, 'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])) {

				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png';
				$config['file_name']     = 'logo';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
					$gambar = $this->upload->data();

					$logo = $gambar['file_name'];
					$where = array();
					$a = $this->m_data->edit_data($where, 'pengaturan')->row();
					$target_file = './gambar/website/' . $a->logo;
					unlink($target_file);

					$this->db->query("UPDATE pengaturan SET logo='$logo'");
				}
			}

			if (!empty($_FILES['bg']['name'])) {

				$config1['upload_path']   = './gambar/website/';
				$config1['allowed_types'] = 'jpg|png';
				$config1['file_name']     = 'bg';

				$this->load->library('upload', $config1);

				if ($this->upload->do_upload('bg')) {
					// mengambil data tentang gambar logo yang diupload
					$bgg = $this->upload->data();

					$bg = $bgg['file_name'];
					$where = array();
					$b = $this->m_data->edit_data($where, 'pengaturan')->row();
					$target_file = './gambar/website/' . $b->bg;
					unlink($target_file);

					$this->db->query("UPDATE pengaturan SET bg='$bg'");
				}
			}

			if (!empty($_FILES['struktur']['name'])) {

				$config2['upload_path']   = './gambar/website/';
				$config2['allowed_types'] = 'jpg|png';
				$config2['file_name']     = 'struktur';

				$this->load->library('upload', $config2);

				if ($this->upload->do_upload('struktur')) {
					// mengambil data tentang gambar logo yang diupload
					$strukturg = $this->upload->data();

					$struktur = $strukturg['file_name'];
					$where = array();
					$b = $this->m_data->edit_data($where, 'pengaturan')->row();
					$target_file = './gambar/website/' . $b->struktur;
					unlink($target_file);

					$this->db->query("UPDATE pengaturan SET struktur='$struktur'");
				}
			}

			redirect(base_url() . 'dashboard/pengaturan/?alert=sukses');
		} else {
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/v_pengaturan', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	// CRUD PENGGUNA
	public function pengguna()
	{
		// check_admin();
		$data['pengguna'] = $this->m_data->get_data('pengguna')->result();
		// $data['pengguna'] = $this->db->query("SELECT * FROM pengguna group by jurusan ")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/pengguna/v_pengguna', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function pengguna_tambah()
	{
		// check_admin();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/pengguna/v_pengguna_tambah');
		$this->load->view('dashboard/layout/v_footer');
	}

	public function pengguna_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
		$this->form_validation->set_rules('email', 'Email Pengguna', 'required');
		$this->form_validation->set_rules('username', 'Username Pengguna', 'required');
		$this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		$this->form_validation->set_rules('status', 'Status Pengguna', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			$data = array(
				'nama' => $nama,
				'email' => $email,
				'username' => $username,
				'password' => $password,
				'level' => $level,
				'status' => $status
			);


			$this->m_data->insert_data($data, 'pengguna');

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/pengguna/v_pengguna_tambah');
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function pengguna_edit($id)
	{
		// check_admin();
		$where = array(
			'id' => $id
		);
		$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/pengguna/v_pengguna_edit', $data);
		$this->load->view('dashboard/layout/v_footer');
	}


	public function pengguna_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
		$this->form_validation->set_rules('email', 'Email Pengguna', 'required|is_unique[pengguna.email]');
		$this->form_validation->set_rules('username', 'Username Pengguna', 'required|is_unique[pengguna.username]');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		$this->form_validation->set_rules('status', 'Status Pengguna', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');

			if ($this->input->post('password') == "") {
				$data = array(
					'nama' => $nama,
					'email' => $email,
					'username' => $username,
					'level' => $level,
					'status' => $status
				);
			} else {
				$data = array(
					'nama' => $nama,
					'email' => $email,
					'username' => $username,
					'password' => $password,
					'level' => $level,
					'status' => $status
				);
			}

			$where = array(
				'id' => $id
			);

			$this->m_data->update_data($where, $data, 'pengguna');

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'id' => $id
			);
			$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
			$this->load->view('dashboard/layout/v_header');
			$this->load->view('dashboard/pengguna/v_pengguna_edit', $data);
			$this->load->view('dashboard/layout/v_footer');
		}
	}

	public function pengguna_hapus($id)
	{
		$where = array(
			'id' => $id
		);
		$data['hapus'] = $this->m_data->edit_data($where, 'pengguna')->row();
		$data['lain'] = $this->db->query("SELECT * FROM pengguna WHERE id != $id")->result();
		$this->load->view('dashboard/layout/v_header');
		$this->load->view('dashboard/pengguna/v_pengguna_hapus', $data);
		$this->load->view('dashboard/layout/v_footer');
	}

	public function pengguna_hapus_aksi()
	{
		$hapus = $this->input->post('hapus');
		$tujuan = $this->input->post('tujuan');

		// hapus pengguna
		$where = array(
			'id' => $hapus
		);

		$this->m_data->delete_data($where, 'pengguna');

		// pindahkan semua berita pengguna yang dihapus ke pengguna yang dipilih
		$w = array(
			'pengguna_berita' => $hapus
		);

		$d = array(
			'pengguna_berita' => $tujuan
		);

		$this->m_data->update_data($w, $d, 'berita');

		redirect(base_url() . 'dashboard/pengguna');
	}
	// end crud pengguna

}
