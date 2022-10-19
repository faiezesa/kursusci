<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return $this->render('login.main',[]);
    }
    
    public function dashboard()
    {
        $data['title'] = 'Home';
        return $this->render('default.main',$data);
    }
}
