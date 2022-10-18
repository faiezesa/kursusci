<?php
namespace App\Controllers;

class Employee extends BaseController{
    public function index(){
        $data['title'] = 'Employee';
        $this->render('employee',$data);
    }
}