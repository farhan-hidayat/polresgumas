<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spmi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
        check_not_login();
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
        $this->load->view('');
    }

    public function penetapan()
    {
        $data = array(
            'nasional' => $this->db->query("SELECT * FROM penetapan,pengguna,kategori WHERE penetapan_user=pengguna_id AND penetapan_kategori=kategori_id AND penetapan_sub='Nasional' order by penetapan_id desc")->result(),
            'institusi' => $this->db->query("SELECT * FROM penetapan,pengguna,kategori WHERE penetapan_user=pengguna_id AND penetapan_kategori=kategori_id AND penetapan_sub='Institusi' order by penetapan_id desc")->result()
        );
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_penetapan', $data);
        $this->load->view('dashboard/foot');
    }
    public function penetapan_tambah()
    {
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_penetapan_tambah', $data);
        $this->load->view('dashboard/foot');
    }
    public function penetapan_aksi()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('sub', 'Sub', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Membuat gambar wajib di isi
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Dokumen', 'required');
        }
        if (empty($_FILES['form']['name'])) {
            $this->form_validation->set_rules('form', 'Dokumen', 'required');
        }

        if ($this->form_validation->run() != false) {

            $config['upload_path']   = './dokumen/spmi/penetapan/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5120;
            $config['file_name']     = $this->input->post('judul');

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file')) {

                // mengambil data tentang gambar
                $dok = $this->upload->data();

                $config1['upload_path']   = './dokumen/spmi/penetapan/';
                $config1['allowed_types'] = 'doc|docx';
                $config1['max_size']      = 5120;
                $config1['file_name']     = 'Form-' . $this->input->post('judul');

                $this->upload->initialize($config1);
                $this->upload->do_upload('form');
                $dok1 = $this->upload->data();

                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $file = $dok['file_name'];
                $form = $dok1['file_name'];
                $user = $this->session->userdata('id');
                $kategori = $this->input->post('kategori');
                $sub = $this->input->post('sub');
                $status = 'Belum Terverifikasi';

                $data = array(
                    'penetapan_tanggal' => $tanggal,
                    'penetapan_judul' => $judul,
                    'penetapan_file' => $file,
                    'penetapan_form' => $form,
                    'penetapan_user' => $user,
                    'penetapan_kategori' => $kategori,
                    'penetapan_sub' => $sub,
                    'penetapan_status' => $status,
                );

                $this->m_data->insert_data($data, 'penetapan');

                redirect(base_url() . 'spmi/penetapan');
            } else {

                $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());
                $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
                $this->load->view('dashboard/head');
                $this->load->view('dashboard/spmi/v_penetapan_tambah', $data);
                $this->load->view('dashboard/foot');
            }
        } else {
            $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_penetapan_tambah', $data);
            $this->load->view('dashboard/foot');
        }
    }

    public function penetapan_edit($id)
    {
        $where = array(
            'penetapan_id' => $id
        );
        $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_penetapan_edit', $data);
        $this->load->view('dashboard/foot');
    }

    public function penetapan_update()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('sub', 'Sub', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');
            $user = $this->session->userdata('id');
            $kategori = $this->input->post('kategori');
            $sub = $this->input->post('sub');

            $where = array(
                'penetapan_id' => $id
            );

            $data = array(
                'penetapan_judul' => $judul,
                'penetapan_user' => $user,
                'penetapan_kategori' => $kategori,
                'penetapan_sub' => $sub,
            );

            $this->m_data->update_data($where, $data, 'penetapan');


            if (!empty($_FILES['file']['name'])) {
                $config['upload_path']   = './dokumen/spmi/penetapan/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']            = 5120;
                $config['file_name']        = $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'penetapan_file' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'penetapan')->row();
                    $target_file = './dokumen/spmi/penetapan/' . $a->penetapan_file;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'penetapan');

                    redirect(base_url() . 'spmi/penetapan');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'penetapan_id' => $id
                    );
                    $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
                    $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_penetapan_edit', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/penetapan');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'penetapan_id' => $id
            );
            $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_penetapan_edit', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function penetapan_verif($id)
    {
        $status = 'Terverifikasi';

        $where = array(
            'penetapan_id' => $id
        );

        $data = array(
            'penetapan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'penetapan');

        redirect(base_url() . 'spmi/penetapan');
    }
    public function penetapan_tolak($id)
    {
        $status = 'Ditolak';

        $where = array(
            'penetapan_id' => $id
        );

        $data = array(
            'penetapan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'penetapan');

        redirect(base_url() . 'spmi/penetapan');
    }
    public function penetapan_form($id)
    {
        $where = array(
            'penetapan_id' => $id
        );
        $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_penetapan_form', $data);
        $this->load->view('dashboard/foot');
    }
    public function penetapan_aksi_form()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');

            $where = array(
                'penetapan_id' => $id
            );

            $data = array(
                'penetapan_judul' => $judul,
            );

            $this->m_data->update_data($where, $data, 'penetapan');


            if (!empty($_FILES['form']['name'])) {
                $config['upload_path']   = './dokumen/spmi/penetapan/';
                $config['allowed_types'] = 'doc|docx';
                $config['max_size']            = 5120;
                $config['file_name']        = 'Form-' . $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('form')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'penetapan_form' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'penetapan')->row();
                    $target_file = './dokumen/spmi/penetapan/' . $a->penetapan_form;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'penetapan');

                    redirect(base_url() . 'spmi/penetapan');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'penetapan_id' => $id
                    );
                    $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_penetapan_form', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/penetapan');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'penetapan_id' => $id
            );
            $data['penetapan'] = $this->m_data->edit_data($where, 'penetapan')->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_penetapan_form', $data);
            $this->load->view('dashboard/foot');
        }
    }

    public function penetapan_hapus($id)
    {
        $where = array(
            'penetapan_id' => $id
        );

        $a = $this->m_data->edit_data($where, 'penetapan')->row();
        $target_file = './dokumen/spmi/penetapan/' . $a->penetapan_file;
        $target_form = './dokumen/spmi/penetapan/' . $a->penetapan_form;
        unlink($target_file);
        unlink($target_form);
        // var_dump($a);
        $this->m_data->delete_data($where, 'penetapan');

        redirect(base_url() . 'spmi/penetapan');
    }

    public function pelaksanaan()
    {
        $user = $this->session->userdata('id');
        $data = array(
            'auditee' => $this->db->query("SELECT * FROM pelaksanaan,pengguna,penetapan WHERE pelaksanaan_user=pengguna_id AND penetapan=penetapan_id AND pelaksanaan_user=$user order by pelaksanaan_id desc")->result(),
            'auditor' => $this->db->query("SELECT * FROM pelaksanaan,pengguna,penetapan,fakultas,prodi WHERE pelaksanaan_user=pengguna_id AND penetapan=penetapan_id AND pengguna_fakultas=fakultas_id AND pengguna_prodi=prodi_id AND pelaksanaan_status='Belum Terverifikasi' order by pelaksanaan_id desc")->result(),
            'institusi' => $this->db->query("SELECT * FROM penetapan,pengguna,kategori WHERE penetapan_user=pengguna_id AND penetapan_kategori=kategori_id AND penetapan_sub='Institusi' order by penetapan_id desc")->result()
        );
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pelaksanaan', $data);
        $this->load->view('dashboard/foot');
    }
    public function pelaksanaan_tambah()
    {
        $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pelaksanaan_tambah', $data);
        $this->load->view('dashboard/foot');
    }
    public function pelaksanaan_aksi()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Membuat gambar wajib di isi
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Dokumen', 'required');
        }

        if ($this->form_validation->run() != false) {

            $config['upload_path']   = './dokumen/spmi/pelaksanaan/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5120;
            $config['file_name']     = $this->input->post('judul');

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file')) {

                // mengambil data tentang gambar
                $dok = $this->upload->data();

                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $file = $dok['file_name'];
                $user = $this->session->userdata('id');
                $kategori = $this->input->post('kategori');
                $status = 'Belum Terverifikasi';

                $data = array(
                    'pelaksanaan_tanggal' => $tanggal,
                    'pelaksanaan_judul' => $judul,
                    'pelaksanaan_file' => $file,
                    'pelaksanaan_user' => $user,
                    'penetapan' => $kategori,
                    'pelaksanaan_status' => $status
                );

                $this->m_data->insert_data($data, 'pelaksanaan');

                redirect(base_url() . 'spmi/pelaksanaan');
            } else {
                $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());
                $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
                $this->load->view('dashboard/head');
                $this->load->view('dashboard/spmi/v_pelaksanaan_tambah', $data);
                $this->load->view('dashboard/foot');
            }
        } else {
            $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_pelaksanaan_tambah', $data);
            $this->load->view('dashboard/foot');
        }
    }

    public function pelaksanaan_edit($id)
    {
        $where = array(
            'pelaksanaan_id' => $id
        );
        $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pelaksanaan_edit', $data);
        $this->load->view('dashboard/foot');
    }

    public function pelaksanaan_update()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');
            $user = $this->session->userdata('id');
            $kategori = $this->input->post('kategori');

            $where = array(
                'pelaksanaan_id' => $id
            );

            $data = array(
                'pelaksanaan_judul' => $judul,
                'pelaksanaan_user' => $user,
                'pelaksanaan_kategori' => $kategori
            );

            $this->m_data->update_data($where, $data, 'pelaksanaan');


            if (!empty($_FILES['file']['name'])) {
                $config['upload_path']   = './dokumen/spmi/pelaksanaan/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']            = 5120;
                $config['file_name']        = $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'pelaksanaan_file' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'pelaksanaan')->row();
                    $target_file = './dokumen/spmi/pelaksanaan/' . $a->pelaksanaan_file;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'pelaksanaan');

                    redirect(base_url() . 'spmi/pelaksanaan');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'pelaksanaan_id' => $id
                    );
                    $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
                    $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_pelaksanaan_edit', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/pelaksanaan');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pelaksanaan_id' => $id
            );
            $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM penetapan WHERE penetapan_sub='Institusi' order by penetapan_id desc")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_pelaksanaan_edit', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function pelaksanaan_hapus($id)
    {
        $where = array(
            'pelaksanaan_id' => $id
        );

        $a = $this->m_data->edit_data($where, 'pelaksanaan')->row();
        $target_file = './dokumen/spmi/pelaksanaan/' . $a->pelaksanaan_file;
        unlink($target_file);
        // var_dump($a);
        $this->m_data->delete_data($where, 'pelaksanaan');

        redirect(base_url() . 'spmi/pelaksanaan');
    }
    public function pelaksanaan_verif($id)
    {
        $status = 'Terverifikasi';

        $where = array(
            'pelaksanaan_id' => $id
        );

        $data = array(
            'pelaksanaan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'pelaksanaan');

        redirect(base_url() . 'spmi/pelaksanaan');
    }
    public function pelaksanaan_tolak($id)
    {
        $status = 'Ditolak';

        $where = array(
            'pelaksanaan_id' => $id
        );

        $data = array(
            'pelaksanaan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'pelaksanaan');

        redirect(base_url() . 'spmi/pelaksanaan');
    }

    public function evaluasi()
    {
        $user = $this->session->userdata('id');
        $data = array(
            'auditee' => $this->db->query("SELECT * FROM evaluasi,pengguna,pelaksanaan WHERE evaluasi_user=pengguna_id AND pelaksanaan=pelaksanaan_id AND pelaksanaan_user=$user order by evaluasi_id desc")->result(),
            'auditor' => $this->db->query("SELECT * FROM evaluasi,pengguna,pelaksanaan,fakultas,prodi WHERE pelaksanaan_user=pengguna_id AND pelaksanaan=pelaksanaan_id AND pengguna_fakultas=fakultas_id AND pengguna_prodi=prodi_id order by evaluasi_id desc")->result()
        );
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_evaluasi', $data);
        $this->load->view('dashboard/foot');
    }
    public function evaluasi_tambah($id)
    {
        $where = array(
            'pelaksanaan_id' => $id
        );
        $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM penetapan,pelaksanaan WHERE penetapan=penetapan_id order by penetapan_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_evaluasi_tambah', $data);
        $this->load->view('dashboard/foot');
    }
    public function evaluasi_aksi()
    {

        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Membuat gambar wajib di isi
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Dokumen', 'required');
        }

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');

            $config['upload_path']   = './dokumen/spmi/evaluasi/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5120;
            $config['file_name']     = $this->input->post('judul');

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file')) {

                // mengambil data tentang gambar
                $dok = $this->upload->data();

                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $file = $dok['file_name'];
                $user = $this->session->userdata('id');
                $kategori = $this->input->post('id');
                $status = 'Belum Terverifikasi';

                $data = array(
                    'evaluasi_tanggal' => $tanggal,
                    'evaluasi_judul' => $judul,
                    'evaluasi_file' => $file,
                    'evaluasi_user' => $user,
                    'pelaksanaan' => $kategori,
                    'evaluasi_status' => $status
                );

                $this->m_data->insert_data($data, 'evaluasi');

                redirect(base_url() . 'spmi/evaluasi');
            } else {
                $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());
                $where = array(
                    'pelaksanaan_id' => $id
                );
                $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
                $data['kategori'] = $this->m_data->get_data('penetapan')->result();
                $this->load->view('dashboard/head');
                $this->load->view('dashboard/spmi/v_evaluasi_tambah', $data);
                $this->load->view('dashboard/foot');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pelaksanaan_id' => $id
            );
            $data['pelaksanaan'] = $this->m_data->edit_data($where, 'pelaksanaan')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM penetapan")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_evaluasi_tambah', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function evaluasi_form($id)
    {
        $where = array(
            'evaluasi_id' => $id
        );
        $data['evaluasi'] = $this->m_data->edit_data($where, 'evaluasi')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_evaluasi_form', $data);
        $this->load->view('dashboard/foot');
    }
    public function evaluasi_aksi_form()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');

            $where = array(
                'evaluasi_id' => $id
            );

            $data = array(
                'evaluasi_judul' => $judul,
            );

            $this->m_data->update_data($where, $data, 'evaluasi');


            if (!empty($_FILES['form']['name'])) {
                $config['upload_path']   = './dokumen/spmi/evaluasi/';
                $config['allowed_types'] = 'doc|docx';
                $config['max_size']            = 5120;
                $config['file_name']        = 'Form-' . $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('form')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'evaluasi_form' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'evaluasi')->row();
                    $target_file = './dokumen/spmi/evaluasi/' . $a->evaluasi_form;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'evaluasi');

                    redirect(base_url() . 'spmi/evaluasi');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'evaluasi_id' => $id
                    );
                    $data['evaluasi'] = $this->m_data->edit_data($where, 'evaluasi')->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_evaluasi_form', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/evaluasi');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'evaluasi_id' => $id
            );
            $data['evaluasi'] = $this->m_data->edit_data($where, 'evaluasi')->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_evaluasi_form', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function evaluasi_hapus($id)
    {
        $where = array(
            'evaluasi_id' => $id
        );

        $a = $this->m_data->edit_data($where, 'evaluasi')->row();
        $target_file = './dokumen/spmi/evaluasi/' . $a->evaluasi_file;
        unlink($target_file);
        // var_dump($a);
        $this->m_data->delete_data($where, 'evaluasi');

        redirect(base_url() . 'spmi/evaluasi');
    }
    public function evaluasi_verif($id)
    {
        $status = 'Terverifikasi';

        $where = array(
            'evaluasi_id' => $id
        );

        $data = array(
            'evaluasi_status' => $status
        );

        $this->m_data->update_data($where, $data, 'evaluasi');

        redirect(base_url() . 'spmi/evaluasi');
    }
    public function evaluasi_tolak($id)
    {
        $status = 'Ditolak';

        $where = array(
            'evaluasi_id' => $id
        );

        $data = array(
            'evaluasi_status' => $status
        );

        $this->m_data->update_data($where, $data, 'evaluasi');

        redirect(base_url() . 'spmi/evaluasi');
    }

    public function pengendalian()
    {
        $user = $this->session->userdata('id');
        $data = array(
            'auditee' => $this->db->query("SELECT * FROM pengendalian,pengguna,evaluasi,pelaksanaan WHERE pelaksanaan_user=pengguna_id and pelaksanaan=pelaksanaan_id AND evaluasi=evaluasi_id AND pelaksanaan_user=$user order by pengendalian_id desc")->result(),
            'auditor' => $this->db->query("SELECT * FROM pengendalian,pengguna,evaluasi,pelaksanaan,fakultas,prodi WHERE pelaksanaan_user=pengguna_id and pelaksanaan=pelaksanaan_id AND pengguna_fakultas=fakultas_id AND pengguna_prodi=prodi_id AND evaluasi=evaluasi_id order by pengendalian_id desc")->result()
        );
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pengendalian', $data);
        $this->load->view('dashboard/foot');
    }
    public function pengendalian_tambah($id)
    {
        $where = array(
            'evaluasi_id' => $id
        );
        $data['evaluasi'] = $this->m_data->edit_data($where, 'evaluasi')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM penetapan,pelaksanaan,evaluasi WHERE penetapan=penetapan_id and pelaksanaan=pelaksanaan_id order by penetapan_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pengendalian_tambah', $data);
        $this->load->view('dashboard/foot');
    }
    public function pengendalian_aksi()
    {

        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Membuat gambar wajib di isi
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Dokumen', 'required');
        }

        if ($this->form_validation->run() != false) {

            $config['upload_path']   = './dokumen/spmi/pengendalian/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5120;
            $config['file_name']     = $this->input->post('judul');

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file')) {

                // mengambil data tentang gambar
                $dok = $this->upload->data();

                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $file = $dok['file_name'];
                $user = $this->session->userdata('id');
                $kategori = $this->input->post('id');
                $status = 'Belum Terverifikasi';

                $data = array(
                    'pengendalian_tanggal' => $tanggal,
                    'pengendalian_judul' => $judul,
                    'pengendalian_file' => $file,
                    'pengendalian_user' => $user,
                    'evaluasi' => $kategori,
                    'pengendalian_status' => $status
                );

                $this->m_data->insert_data($data, 'pengendalian');

                redirect(base_url() . 'spmi/pengendalian');
            } else {
                $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());
                $id = $this->input->post('id');
                $where = array(
                    'evaluasi_id' => $id
                );
                $data['evaluasi'] = $this->m_data->edit_data($id, 'evaluasi')->result();
                $data['kategori'] = $this->m_data->get_data('penetapan')->result();
                $this->load->view('dashboard/head');
                $this->load->view('dashboard/spmi/v_pengendalian_tambah', $data);
                $this->load->view('dashboard/foot');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'evaluasi_id' => $id
            );
            $data['evaluasi'] = $this->m_data->edit_data($where, 'evaluasi')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM penetapan")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_pengendalian_tambah', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function pengendalian_form($id)
    {
        $where = array(
            'pengendalian_id' => $id
        );
        $data['pengendalian'] = $this->m_data->edit_data($where, 'pengendalian')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_pengendalian_form', $data);
        $this->load->view('dashboard/foot');
    }
    public function pengendalian_aksi_form()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');

            $where = array(
                'pengendalian_id' => $id
            );

            $data = array(
                'pengendalian_judul' => $judul,
            );

            $this->m_data->update_data($where, $data, 'pengendalian');


            if (!empty($_FILES['form']['name'])) {
                $config['upload_path']   = './dokumen/spmi/pengendalian/';
                $config['allowed_types'] = 'doc|docx';
                $config['max_size']            = 5120;
                $config['file_name']        = 'Form-' . $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('form')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'pengendalian_form' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'pengendalian')->row();
                    $target_file = './dokumen/spmi/pengendalian/' . $a->pengendalian_form;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'pengendalian');

                    redirect(base_url() . 'spmi/pengendalian');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'pengendalian_id' => $id
                    );
                    $data['pengendalian'] = $this->m_data->edit_data($where, 'pengendalian')->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_pengendalian_form', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/pengendalian');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pengendalian_id' => $id
            );
            $data['pengendalian'] = $this->m_data->edit_data($where, 'pengendalian')->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_pengendalian_form', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function pengendalian_hapus($id)
    {
        $where = array(
            'pengendalian_id' => $id
        );

        $a = $this->m_data->edit_data($where, 'pengendalian')->row();
        $target_file = './dokumen/spmi/pengendalian/' . $a->pengendalian_file;
        unlink($target_file);
        // var_dump($a);
        $this->m_data->delete_data($where, 'pengendalian');

        redirect(base_url() . 'spmi/pengendalian');
    }
    public function pengendalian_verif($id)
    {
        $status = 'Terverifikasi';

        $where = array(
            'pengendalian_id' => $id
        );

        $data = array(
            'pengendalian_status' => $status
        );

        $this->m_data->update_data($where, $data, 'pengendalian');

        redirect(base_url() . 'spmi/pengendalian');
    }
    public function pengendalian_tolak($id)
    {
        $status = 'Ditolak';

        $where = array(
            'pengendalian_id' => $id
        );

        $data = array(
            'pengendalian_status' => $status
        );

        $this->m_data->update_data($where, $data, 'pengendalian');

        redirect(base_url() . 'spmi/pengendalian');
    }

    public function peningkatan()
    {
        $user = $this->session->userdata('id');
        $data = array(
            'auditee' => $this->db->query("SELECT * FROM peningkatan,pengguna,pengendalian,evaluasi,pelaksanaan WHERE peningkatan_user=pengguna_id AND pengendalian=pengendalian_id AND peningkatan_user=$user order by peningkatan_id desc")->result(),
            'auditor' => $this->db->query("SELECT * FROM peningkatan,pengguna,pengendalian,evaluasi,pelaksanaan,fakultas,prodi WHERE pelaksanaan_user=pengguna_id and pelaksanaan=pelaksanaan_id AND pengguna_fakultas=fakultas_id AND pengguna_prodi=prodi_id AND evaluasi=evaluasi_id AND pengendalian=pengendalian_id order by peningkatan_id desc")->result()
        );
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_peningkatan', $data);
        $this->load->view('dashboard/foot');
    }
    public function peningkatan_tambah($id)
    {
        $where = array(
            'pengendalian_id' => $id
        );
        $data['pengendalian'] = $this->m_data->edit_data($where, 'pengendalian')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM penetapan,pelaksanaan,evaluasi,pengendalian WHERE penetapan=penetapan_id and pelaksanaan=pelaksanaan_id and evaluasi=evaluasi_id and pengendalian_id=$id order by penetapan_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_peningkatan_tambah', $data);
        $this->load->view('dashboard/foot');
    }
    public function peningkatan_aksi()
    {

        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Membuat gambar wajib di isi
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'Dokumen', 'required');
        }

        if ($this->form_validation->run() != false) {

            $config['upload_path']   = './dokumen/spmi/peningkatan/';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5120;
            $config['file_name']     = $this->input->post('judul');

            $this->load->library('upload', $config);


            if ($this->upload->do_upload('file')) {

                // mengambil data tentang gambar
                $dok = $this->upload->data();

                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $file = $dok['file_name'];
                $user = $this->session->userdata('id');
                $kategori = $this->input->post('id');
                $status = 'Belum Terverifikasi';

                $data = array(
                    'peningkatan_tanggal' => $tanggal,
                    'peningkatan_judul' => $judul,
                    'peningkatan_file' => $file,
                    'peningkatan_user' => $user,
                    'pengendalian' => $kategori,
                    'peningkatan_status' => $status
                );

                $this->m_data->insert_data($data, 'peningkatan');

                redirect(base_url() . 'spmi/peningkatan');
            } else {
                $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());
                $id = $this->input->post('id');
                $where = array(
                    'pengendalian_id' => $id
                );
                $data['pengendalian'] = $this->m_data->edit_data($id, 'pengendalian')->result();
                $data['kategori'] = $this->m_data->get_data('penetapan')->result();
                $this->load->view('dashboard/head');
                $this->load->view('dashboard/spmi/v_peningkatan_tambah', $data);
                $this->load->view('dashboard/foot');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pengendalian_id' => $id
            );
            $data['pengendalian'] = $this->m_data->edit_data($where, 'pengendalian')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM penetapan")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_peningkatan_tambah', $data);
            $this->load->view('dashboard/foot');
        }
    }

    public function peningkatan_edit($id)
    {
        $where = array(
            'peningkatan_id' => $id
        );
        $data['peningkatan'] = $this->m_data->edit_data($where, 'peningkatan')->result();
        $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
        $this->load->view('dashboard/head');
        $this->load->view('dashboard/spmi/v_peningkatan_edit', $data);
        $this->load->view('dashboard/foot');
    }

    public function peningkatan_update()
    {
        // Wajib isi judul,konten dan kategori
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('sub', 'Sub', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $judul = $this->input->post('judul');
            $user = $this->session->userdata('id');
            $kategori = $this->input->post('kategori');
            $sub = $this->input->post('sub');

            $where = array(
                'peningkatan_id' => $id
            );

            $data = array(
                'peningkatan_judul' => $judul,
                'peningkatan_user' => $user,
                'peningkatan_kategori' => $kategori,
                'peningkatan_sub' => $sub,
            );

            $this->m_data->update_data($where, $data, 'peningkatan');


            if (!empty($_FILES['file']['name'])) {
                $config['upload_path']   = './dokumen/spmi/peningkatan/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']            = 5120;
                $config['file_name']        = $this->input->post('judul');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {

                    // mengambil data tentang gambar
                    $file = $this->upload->data();

                    $data = array(
                        'peningkatan_file' => $file['file_name'],
                    );

                    $a = $this->m_data->edit_data($where, 'peningkatan')->row();
                    $target_file = './dokumen/spmi/peningkatan/' . $a->peningkatan_file;
                    unlink($target_file);

                    $this->m_data->update_data($where, $data, 'peningkatan');

                    redirect(base_url() . 'spmi/peningkatan');
                } else {
                    $this->form_validation->set_message('file', $data['gambar_error'] = $this->upload->display_errors());

                    $where = array(
                        'peningkatan_id' => $id
                    );
                    $data['peningkatan'] = $this->m_data->edit_data($where, 'peningkatan')->result();
                    $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
                    $this->load->view('dashboard/head');
                    $this->load->view('dashboard/spmi/v_peningkatan_edit', $data);
                    $this->load->view('dashboard/foot');
                }
            } else {
                redirect(base_url() . 'spmi/peningkatan');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'peningkatan_id' => $id
            );
            $data['peningkatan'] = $this->m_data->edit_data($where, 'peningkatan')->result();
            $data['kategori'] = $this->db->query("SELECT * FROM kategori WHERE ket='SPMI' order by kategori_id desc")->result();
            $this->load->view('dashboard/head');
            $this->load->view('dashboard/spmi/v_peningkatan_edit', $data);
            $this->load->view('dashboard/foot');
        }
    }
    public function peningkatan_hapus($id)
    {
        $where = array(
            'peningkatan_id' => $id
        );

        $a = $this->m_data->edit_data($where, 'peningkatan')->row();
        $target_file = './dokumen/spmi/peningkatan/' . $a->peningkatan_file;
        unlink($target_file);
        // var_dump($a);
        $this->m_data->delete_data($where, 'peningkatan');

        redirect(base_url() . 'spmi/peningkatan');
    }
    public function peningkatan_verif($id)
    {
        $status = 'Terverifikasi';

        $where = array(
            'peningkatan_id' => $id
        );

        $data = array(
            'peningkatan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'peningkatan');

        redirect(base_url() . 'spmi/peningkatan');
    }
    public function peningkatan_tolak($id)
    {
        $status = 'Ditolak';

        $where = array(
            'peningkatan_id' => $id
        );

        $data = array(
            'peningkatan_status' => $status
        );

        $this->m_data->update_data($where, $data, 'peningkatan');

        redirect(base_url() . 'spmi/peningkatan');
    }
}
