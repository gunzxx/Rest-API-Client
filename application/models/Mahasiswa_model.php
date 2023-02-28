<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_Model {
    private $client;

    public function __construct()
    {
        // parent::__construct();
        $this->client = new Client([
            'base_uri' => "http://localhost/05_API/07_Rest_Server/api/",
            'auth' => ['admin','123']
        ]);
    }

    /**
     * Mengambil seluruh mahasiswa
     * Query Builder Class
     */
    public function getAll()
    {
        try{
            $response = $this->client->request('GET',"mahasiswa",[
                'query' => ["gunz_key"=>123]
            ]);
            
            $hasil = json_decode($response->getBody()->getContents(),1);
            return $hasil['data'];
        }
        catch(GuzzleHttp\Exception\BadResponseException $e){
            return false;
        }
    }
    
    /**
     * Mengambil satu data mahasiswa
     * Query Builder Class
     */
    public function getSingle($id)
    {
        try{
            $response = $this->client->request('GET',"mahasiswa",[
                'query' => [
                    "gunz_key"=>123,
                    "id"=>$id,
                ]
            ]);
        
            $hasil = json_decode($response->getBody()->getContents(),1);
    
            return $hasil['data'][0];
        }
        catch(GuzzleHttp\Exception\BadResponseException $e){
            return false;
        }
    }

    /**
     * Mengambil data mahasiswa dengan spesifik
     * Query Builder Class
     */
    public function getSpesifik($keyword = '')
    {
        return $this->db
                    ->like('nama',$keyword)
                    ->or_like('nim',$keyword)
                    ->or_like('email',$keyword)
                    ->get('mahasiswa')
                    ->result_array();
    }
    
    /**
     * Menambah data mahasiswa
     */
    public function tambahDataMahasiswa()
    {
        try{
            $data = [
                "nama" => $this->input->post('nama',true),
                "nim" => $this->input->post('nim',true),
                "email" => $this->input->post('email',true),
                "prodi_id" => $this->input->post('prodi',true),
                "gunz_key"=>123,
            ];
            
            $response = $this->client->request('POST',"mahasiswa",[
                'form_params' => $data
            ]);
            
            return json_decode($response->getBody()->getContents(),1);
        }
        catch(GuzzleHttp\Exception\BadResponseException $e){
            echo $e;die;
            return "error";
        }
    }
    
    /**
     * Menngubah data mahasiswa
     */
    public function ubahDataMahasiswa($id)
    {
        // $data = [
        //     "nama" => $this->input->post('nama',true),
        //     "nim" => $this->input->post('nim',true),
        //     "email" => $this->input->post('email',true),
        //     "prodi_id" => $this->input->post('prodi',true),
        // ];
        
        // $this->db->where(['id'=>$id])->update('mahasiswa',$data);
        // return $this->db->affected_rows();
        try{
            $data = [
                "nama" => $this->input->post('nama',true),
                "nim" => $this->input->post('nim',true),
                "email" => $this->input->post('email',true),
                "prodi_id" => $this->input->post('prodi',true),
                "id" => $id,
                "gunz_key"=>123,
            ];
            
            $response = $this->client->request('PUT',"mahasiswa",[
                'form_params' => $data
            ]);

            $hasil = json_decode($response->getBody()->getContents(),1);
            if($hasil['status']==0){
                return 0;
            }
            else if($hasil['status']==true){
                return 1;
            }
            else{
                var_dump($hasil);die;
            }
        }
        catch(GuzzleHttp\Exception\BadResponseException $e){
            echo $e;die;
            return "error";
        }
    }

    /**
     * Menghapus data mahasiswa
     */
    public function hapusDataMahasiswa($id)
    {
        try{
            $response = $this->client->request('DELETE',"mahasiswa",[
                'form_params' => [
                    "gunz_key"=>123,
                    "id"=>$id,
                ]
            ]);
        
            $hasil = json_decode($response->getBody()->getContents(),1);
    
            return $hasil['count'];
        }
        catch(GuzzleHttp\Exception\BadResponseException $e){
            return "error";
        }
    }
    
    /**
     * Menghapus data mahasiswa dan mengambil row yg terpengaruh
     */
    public function hapusDataGetRows($id)
    {
        return $this->hapusDataMahasiswa($id);
    }
}

?>