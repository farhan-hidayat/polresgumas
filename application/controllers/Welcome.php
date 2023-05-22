<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');
	}

	public function index()
	{
		// data pengaturan website
		$data['jumlah_berita'] = $this->db->query("SELECT count(id) as jml FROM berita WHERE status_berita = 'Publish'")->row('jml');
		$data['jumlah_gallery'] = $this->db->query("SELECT count(id) as jml FROM gallery WHERE status_gallery = 'Publish'")->row('jml');

		$data['berita'] = $this->db->query("SELECT * FROM berita,kategori,pengguna WHERE kategori_berita=kategori.id and pengguna_berita=pengguna.id and status_berita = 'Publish' order by tanggal_berita desc limit 8")->result();
		$data['gallery'] = $this->db->query("SELECT * FROM gallery,kategori,pengguna WHERE kategori_gallery=kategori.id and pengguna_gallery=pengguna.id and status_gallery = 'Publish' order by tanggal_gallery desc limit 8")->result();

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_homepage', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function profil()
	{
		// data pengaturan website
		$data['jumlah_berita'] = $this->db->query("SELECT count(id) as jml FROM berita WHERE status_berita = 'Publish'")->row('jml');
		$data['jumlah_gallery'] = $this->db->query("SELECT count(id) as jml FROM gallery WHERE status_gallery = 'Publish'")->row('jml');

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_profil', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function berita()
	{
		// data pengaturan website
		$data['jumlah_kategori'] = $this->db->query("SELECT count(id) as jml FROM kategori WHERE ket_kategori = 'Berita'")->row('jml');
		$data['jumlah_berita'] = $this->db->query("SELECT count(id) as jml FROM berita WHERE status_berita = 'Publish'")->row('jml');

		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori = 'Berita' order by id DESC")->result();
		$data['berita'] = $this->db->query("SELECT * FROM berita,kategori,pengguna WHERE kategori_berita=kategori.id and pengguna_berita=pengguna.id and status_berita = 'Publish' order by tanggal_berita desc")->result();


		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_berita', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function kat_berita($slug)
	{
		// data pengaturan website
		$data['jumlah_kategori'] = $this->db->query("SELECT count(id) as jml FROM kategori WHERE ket_kategori = 'Berita'")->row('jml');
		$data['jumlah_berita'] = $this->db->query("SELECT count(berita.id) as jml, slug_kategori FROM berita,kategori WHERE kategori_berita=kategori.id and status_berita = 'Publish' and slug_kategori='$slug'")->row('jml');

		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori = 'Berita' order by id DESC")->result();
		$data['berita'] = $this->db->query("SELECT * FROM berita,kategori,pengguna WHERE kategori_berita=kategori.id and pengguna_berita=pengguna.id and status_berita = 'Publish' and slug_kategori='$slug' order by tanggal_berita desc")->result();


		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_berita', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function berita_detail($slug)
	{
		// data pengaturan website
		// $data['jumlah_kategori'] = $this->db->query("SELECT count(id) as jml FROM kategori WHERE ket_kategori = 'Berita'")->row('jml');
		// $data['jumlah_berita'] = $this->db->query("SELECT count(id) as jml FROM berita WHERE status_berita = 'Publish'")->row('jml');

		// $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori = 'Berita' order by id DESC")->result();
		$data['berita'] = $this->db->query("SELECT * FROM berita,kategori,pengguna WHERE kategori_berita=kategori.id and pengguna_berita=pengguna.id and status_berita = 'Publish' and slug_berita='$slug'")->row();


		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_berita_detail', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function gallery()
	{
		// data pengaturan website
		$data['jumlah_kategori'] = $this->db->query("SELECT count(id) as jml FROM kategori WHERE ket_kategori = 'Galeri'")->row('jml');
		$data['jumlah_gallery'] = $this->db->query("SELECT count(id) as jml FROM gallery WHERE status_gallery = 'Publish'")->row('jml');

		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori = 'Galeri' order by id DESC")->result();
		$data['gallery'] = $this->db->query("SELECT * FROM gallery,kategori,pengguna WHERE kategori_gallery=kategori.id and pengguna_gallery=pengguna.id and status_gallery = 'Publish' order by tanggal_gallery desc")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_gallery', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function kat_gallery($slug)
	{
		// data pengaturan website
		$data['jumlah_kategori'] = $this->db->query("SELECT count(id) as jml FROM kategori WHERE ket_kategori = 'Galeri'")->row('jml');
		$data['jumlah_gallery'] = $this->db->query("SELECT count(gallery.id) as jml, slug_kategori FROM gallery,kategori WHERE kategori_gallery=kategori.id and status_gallery = 'Publish' and slug_kategori='$slug'")->row('jml');

		$data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket_kategori = 'Galeri' order by id DESC")->result();
		$data['gallery'] = $this->db->query("SELECT * FROM gallery,kategori,pengguna WHERE kategori_gallery=kategori.id and pengguna_gallery=pengguna.id and status_gallery = 'Publish' and slug_kategori='$slug' order by tanggal_gallery desc")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_gallery', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function kategori($slug)
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		$jumlah_berita = $this->db->query("SELECT * FROM berita,pengguna,kategori WHERE status_berita='Publish' AND pengguna_berita=pengguna.id AND kategori_berita=kategori.id AND kategori_slug='$slug'")->num_rows();

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'kategori/' . $slug;
		$config['total_rows'] = $jumlah_berita;
		$config['per_page'] = 2;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(3);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['berita'] = $this->db->query("SELECT * FROM berita,pengguna,kategori WHERE status_berita='Publish' AND pengguna_berita=pengguna.id AND kategori_berita=kategori.id AND kategori_slug='$slug' ORDER BY berita.id DESC LIMIT $config[per_page] OFFSET $from")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_kategori', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function polsek()
	{
		// data pengaturan website
		$data['jumlah_polsek'] = $this->db->query("SELECT count(id) as jml FROM polsek")->row('jml');

		$data['polsek'] = $this->db->query("SELECT * FROM polsek order by id desc")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_polsek', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function polsek_detail($slug)
	{
		// data pengaturan website

		$data['polsek'] = $this->db->query("SELECT * FROM polsek WHERE slug_polsek='$slug'")->row();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_polsek_detail', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function satker()
	{
		// data pengaturan website
		$data['jumlah_satker'] = $this->db->query("SELECT count(id) as jml FROM satker")->row('jml');

		$data['satker'] = $this->db->query("SELECT * FROM satker order by id desc")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_satker', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}
	public function satker_detail($slug)
	{
		// data pengaturan website
		$data['jumlah_satker'] = $this->db->query("SELECT count(id) as jml FROM satker")->row('jml');

		$data['satker'] = $this->db->query("SELECT * FROM satker where slug_satker='$slug'")->row();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_satker_detail', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function notfound()
	{
		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_notfound', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function pengaduan()
	{
		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_pengaduan', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function pengaduan_aksi()
	{
		$this->form_validation->set_rules('pengaduan', 'pengaduan', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('jenis', 'jenis', 'required');

		if ($this->form_validation->run() != false) {

			$pengaduan = $this->input->post('pengaduan');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$jenis = $this->input->post('jenis');
			$tanggal = date('Y-m-d H:i:s');

			$data = array(
				'nama_pengadu' => $nama,
				'email_pengadu' => $email,
				'jenis_pengaduan' => $jenis,
				'isi_pengaduan' => $pengaduan,
				'tanggal_pengaduan' => $tanggal,
				'status_pengaduan' => "Belum"
			);

			$this->m_data->insert_data($data, 'pengaduan');

			redirect(base_url());
		} else {
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
			$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
			$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

			// SEO META
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;

			$this->load->view('frontend/layout/v_header', $data);
			$this->load->view('frontend/v_pengaduan', $data);
			$this->load->view('frontend/layout/v_footer', $data);
		}
	}
}
