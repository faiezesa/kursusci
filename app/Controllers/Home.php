<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->render('login.main',[]);
    }
    
    public function dashboard()
    {
        $data['title'] = 'Home';
        $this->render('default.main',$data);
    }
}
