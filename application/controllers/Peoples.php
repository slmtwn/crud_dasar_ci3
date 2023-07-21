<?php
class Peoples extends CI_Controller
{
    public function index()
    {
        $this->load->model('Peoples_model');

        // load library
        $this->load->library('pagination');

        // ambil data keyword 
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // config
        $this->db->like('nama', $data['keyword']);
        $this->db->from('peoples');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 8;

        // initilize
        $this->pagination->initialize($config);


        // judul Halaman
        $data['judul'] = 'Halaman Peoples';


        $data['start'] = $this->uri->segment(3);
        $data['peoples'] = $this->Peoples_model->getPeoples($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('peoples/index', $data);
        $this->load->view('templates/footer');
    }
}
