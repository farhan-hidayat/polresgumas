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
		// 3 artikel terbaru
		// $data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna_id AND kategori_artikel=kategori_id ORDER BY artikel_id DESC LIMIT 3")->result();
		// $data['gallery'] = $this->db->query("SELECT * FROM gallery,pengguna,kategori WHERE status='Publish' AND author=pengguna_id AND kategori=kategori_id ORDER BY gallery_id DESC LIMIT 3")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['gallery'] = $this->db->query("SELECT * FROM gallery,kategori,pengguna WHERE kategori_gallery=kategori.id and pengguna_gallery=pengguna.id order by tanggal_gallery desc")->result();
		$data['layanan'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=1 ORDER BY id DESC")->result();
		$data['informasi'] = $this->db->query("SELECT * FROM aplikasi WHERE kategori_aplikasi=2 ORDER BY id DESC")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_homepage', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function single($slug)
	{
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna.id AND kategori_artikel=kategori.id AND slug_artikel='$slug'")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		if (count($data['artikel']) > 0) {
			$data['meta_keyword'] = $data['artikel'][0]->artikel_judul;
			$data['meta_description'] = substr($data['artikel'][0]->artikel_konten, 0, 100);
		} else {
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;
		}

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_single', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function blog()
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;


		// $this->load->database();
		$jumlah_data = $this->m_data->get_data('artikel')->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'blog/';
		$config['total_rows'] = $jumlah_data;
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


		$from = $this->uri->segment(2);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna.id AND kategori_artikel=kategori.id ORDER BY artikel.id DESC LIMIT $config[per_page] OFFSET $from")->result();

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_blog', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function gallery()
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;


		// $this->load->database();
		$jumlah_data = $this->m_data->get_data('gallery')->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'gallery/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 6;

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


		$from = $this->uri->segment(2);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['gallery'] = $this->db->query("SELECT * FROM gallery,pengguna,kategori WHERE status='Publish' AND pengguna=pengguna.id AND kategori_gallery=kategori.id ORDER BY gallery.id DESC LIMIT $config[per_page] OFFSET $from")->result();

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_gallery', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}


	public function page($slug)
	{
		$where = array(
			'halaman_slug' => $slug
		);

		$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_page', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function kategori($slug)
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		$jumlah_artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna.id AND kategori_artikel=kategori.id AND kategori_slug='$slug'")->num_rows();

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'kategori/' . $slug;
		$config['total_rows'] = $jumlah_artikel;
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

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna.id AND kategori_artikel=kategori.id AND kategori_slug='$slug' ORDER BY artikel.id DESC LIMIT $config[per_page] OFFSET $from")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_kategori', $data);
		$this->load->view('frontend/layout/v_footer', $data);
	}

	public function search()
	{
		//mengambil nilai keyword dari form pencarian
		$cari = htmlentities((trim($this->input->post('cari', true))) ? trim($this->input->post('cari', true)) : '');

		//jika uri segmen 2 ada, maka nilai variabel $search akan diganti dengan nilai uri segmen 2
		$cari = ($this->uri->segment(2)) ? $this->uri->segment(2) : $cari;

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$jumlah_artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna.id AND kategori_artikel=kategori.id AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')")->num_rows();

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'search/' . $cari;
		$config['total_rows'] = $jumlah_artikel;
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

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna_id AND kategori_artikel=kategori_id AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%') ORDER BY artikel_id DESC LIMIT $config[per_page] OFFSET $from")->result();
		$data['cari'] = $cari;
		$this->load->view('frontend/layout/v_header', $data);
		$this->load->view('frontend/v_search', $data);
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
		// 3 artikel terbaru
		// $data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE status_artikel='Publish' AND pengguna_artikel=pengguna_id AND kategori_artikel=kategori_id ORDER BY artikel_id DESC LIMIT 3")->result();
		// $data['gallery'] = $this->db->query("SELECT * FROM gallery,pengguna,kategori WHERE status='Publish' AND author=pengguna_id AND kategori=kategori_id ORDER BY gallery_id DESC LIMIT 3")->result();

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
