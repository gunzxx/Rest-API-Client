<?php

use GuzzleHttp\Client;

class Prodi_model extends CI_Model {

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
     * Mengambil semua data prodi
     */
    public function getAll()
    {
        return $this->db->get('prodi')->result_array();
    }

    /**
     * Mengambil hanya satu data prodi
     */
    public function getProdiSingle($id)
    {
        $response = $this->client->request('GET',"prodi",[
        'query' => [
            "gunz_key"=>123,
            "id"=>$id,
            ]
        ]);
    
        $hasil = json_decode($response->getBody()->getContents(),1);
        return $hasil['data'];
    }
    
    /**
     * Mengambil prodi spesific di dalam prodi_id yang diberikan
     */
    public function getProdiSpesific(array|int $id = [])
    {
        return $this->db->where_in('id',$id)->get('prodi')->row_array();
    }
}

?>