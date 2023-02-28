<?php

class Home extends CI_Controller{
    /**
     * Variabel untuk menampung data yang akan dikirim
     */
    public $data = [];

    /**
     * Konstruktor untuk class ini
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['base'] = base_url();
    }

    /**
     * Fungsi index pada class ini
     */
    public function index($nama = '')
    {
        $data = $this->data;
        $nama = 'Gunz';
        $data['judul'] = 'Home';
        $data['nama'] = $nama;
        $this->load->view('templates/header',$data);
        $this->load->view('home/index',$data);
        $this->load->view('templates/footer');
    }
}

?>