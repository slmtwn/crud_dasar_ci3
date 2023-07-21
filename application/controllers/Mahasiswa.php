<?php
class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // load model di class Mahasiswa
        $this->load->model('Mahasiswa_model');
        // memanggil form validation
        $this->load->library('form_validation');
    }
    public function index()
    {
        // untuk judul
        $data['judul'] = 'Halaman Mahasiswa';

        // load model untuk menampilkan data
        $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        }
        // load halaman view
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $data['judul'] = 'Tambah Data Mahasiswa';
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('mahasiswa');
        }
    }

    public function hapus($id)
    {
        $this->Mahasiswa_model->hapusDataMahasiswa($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('mahasiswa');
    }

    public function detail($id)
    {
        // untuk judul
        $data['judul'] = 'Halaman Detail Mahasiswa';

        // load model untuk menampilkan data
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);

        // load halaman view
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $data['judul'] = 'Ubah  Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
        $data['jurusan'] = ['Teknik Informatika', 'Teknik Lingkungan', 'Teknik Planologi', 'Teknik Mesin', 'Teknik Elektro'];
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswa_model->ubahDataMahasiswa();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('mahasiswa');
        }
    }
}
