<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Halaman About';

        $this->load->view('templates/header', $data);
        $this->load->view('About/index');
        $this->load->view('templates/footer');
    }
}
