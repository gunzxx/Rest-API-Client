<?php
class Mahasiswa extends CI_Controller{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['base'] = base_url();
        $this->load->model('Mahasiswa_model');
        $this->load->model('Prodi_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data = $this->data;
        $data['mahasiswa'] = $this->Mahasiswa_model->getAll();
        if($this->input->post('keyword'))
        {
            $keyword = $this->input->post('keyword');
            $data['mahasiswa'] = $this->Mahasiswa_model->getSpesifik($keyword);
            $data['keyword']=$keyword;
        }

        $data['judul'] = 'Mahasiswa';

        $this->load->view('templates/header',$data);
        $this->load->view('mahasiswa/index',$data);
        $this->load->view('templates/footer');
    }
    
    public function tambah()
    {
        $data = $this->data;
        $data['judul'] = 'Tambah Data Mahasiswa';

        $this->form_validation->set_rules('nama','Nama',['required']);
        $this->form_validation->set_rules('nim','Nim',['required','numeric','is_unique[mahasiswa.nim]']);
        $this->form_validation->set_rules('email','Email',['required','valid_email']);

        if($this->form_validation->run()==FALSE){
            $data['prodi'] = $this->Prodi_model->getAll();
            
            $this->session->set_flashdata('tambah','gagal');
            $this->load->view('templates/header',$data);
            $this->load->view('mahasiswa/tambah');
            $this->load->view('templates/footer');
        }
        else{
            $this->Mahasiswa_model->tambahDataMahasiswa();
            $this->session->set_flashdata('tambah','berhasil');
            redirect('mahasiswa');
        }
    }

    public function hapus($id = null)
    {
        if($id == null){
            return redirect('mahasiswa');
        }
        $numr = $this->Mahasiswa_model->hapusDataGetRows($id);
        
        // var_dump($numr);die;
        if($numr == 1 || $numr == "1")
        {
            $this->session->set_flashdata('hapus','berhasil');
        }
        else
        {
            $this->session->set_flashdata('hapus','gagal');
        }
    
        redirect('mahasiswa');
    }

    public function detail($id)
    {
        $data = $this->data;
        $data['judul'] = "Detail Mahasiswa";
        $data['mahasiswa'] = $this->Mahasiswa_model->getSingle($id);
        if($data['mahasiswa'] != null)
        {
            $prodi_id = $data['mahasiswa']['prodi_id'];
            $data['prodi'] = $this->Prodi_model->getProdiSingle($prodi_id);
        }
        else
        {
            $data['error']=true;
        }
        $this->load->view('templates/header',$data);
        $this->load->view('mahasiswa/detail',$data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data = $this->data;
        $data['judul'] = "Edit Mahasiswa";
        $data['mahasiswa'] = $this->Mahasiswa_model->getSingle($id);

        if($data['mahasiswa'] != null)
        {
            $this->form_validation->set_rules('nama','Nama',['required']);
            $this->form_validation->set_rules('email','Email',['required','valid_email']);

            $data['prodi'] = $this->Prodi_model->getAll();

            if($this->input->post('nim') == $data['mahasiswa']['nim'])
            {
                $this->form_validation->set_rules('nim','Nim',['required','numeric']);
            }
            else
            {
                $this->form_validation->set_rules('nim','Nim',['required','numeric','is_unique[mahasiswa.nim]']);
            }
    
            if($this->form_validation->run()==FALSE){
                $this->load->view('templates/header',$data);
                $this->load->view('mahasiswa/edit',$data);
                $this->load->view('templates/footer');
            }
            else{
                $numrow = $this->Mahasiswa_model->ubahDataMahasiswa($id);
                if($numrow == 1)
                {
                    $this->session->set_flashdata('ubah','berhasil');
                }
                else if($numrow == 0)
                {
                    $this->session->set_flashdata('ubah','tidak');
                }
                else
                {
                    $this->session->set_flashdata('ubah','gagal');
                }
                redirect('mahasiswa');
            }
        }
        else
        {
            $data['error']=true;
            $this->load->view('templates/header',$data);
            $this->load->view('mahasiswa/edit',$data);
            $this->load->view('templates/footer');
        }
    }
}

?>