<?php

class About extends CI_Controller{
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
    public function index()
    {
        $data = $this->data;
        $data['judul'] = 'About';
        $this->load->view('templates/header',$data);
        $this->load->view('about/index',$data);
        $this->load->view('templates/footer');
    }
}

?>