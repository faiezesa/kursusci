<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIReligion extends ResourceController
{
    public function __construct()
    {
        $this->rel = model('App\Models\ReligionModel');
    }
    
    public function index()
    {
        if(!$this->request->isAJAX()){
            exit('Maaf! Tidak dibenarkan akses');
        }
        $data = $this->rel->find();
        return $this->respond($data);
        
    }
}
