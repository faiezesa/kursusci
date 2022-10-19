<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class APIRace extends ResourceController
{
    public function __construct()
    {
        $this->race = model('App\Models\RaceModel');
    }
    
    public function index()
    {
        if(!$this->request->isAJAX()){
            exit('Maaf! Tidak dibenarkan akses');
        }
        $data = $this->race->find();
        return $this->respond($data);
    }
}
