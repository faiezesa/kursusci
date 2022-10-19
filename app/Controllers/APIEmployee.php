<?php
    
    namespace App\Controllers;
    
    use CodeIgniter\RESTful\ResourceController;
    
    class APIEmployee extends ResourceController
    {
        public function __construct()
        {
            $this->mod = model('App\Models\EmployeeModel');
            $this->dam = model('App\Models\DeptAssignModel');
        }
        
        public function listing()
        {
            helper('function');
            
            $filter['search'] = $this->request->getVar('search');
            $filter['limit'] = $this->request->getVar('limit');
            
            $page = $this->request->getVar('page');
            $limit = ($filter['limit']) ? $filter['limit'] : 10;
            $offset = pagingOffset($page, $limit);
            
            $employee = $this->mod->datatable($limit, $offset, $filter);
            $data_count = $this->mod->datacount($filter);
            $page = (int)$page;
            $page_count = pagingTotalPage($data_count, $limit);
            $data = [
                "page"       => $page,
                "per_page"   => $limit,
                "total_page" => $page_count,
                "total_data" => $data_count,
                "data"       => $employee, // list of data employee
            ];
            return $this->respond($data);
        }
        
        public function delete_data(){
            $id = $this->request->getVar('del');
            $this->mod->delete($id);
            $this->dam->where('empt_id',$id)->delete();
        }
        
        public function proses_data()
        {
            $proses = $this->request->getVar('act');
            
            $rules = [
                'name'  => 'required|max_length[255]',
                'email' => 'required|valid_email',
                'icno'  => 'required|numeric'
            ];
    
            $data = [
                'name'  => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'icno'  => $this->request->getVar('icno'),
            ];
            
            if ($proses == 'add') {
                if (!$this->validate($rules)) {
                    $error['populate'] =$data; //try populate data form
                    $error['errors'] = $this->validator->getErrors();
                    
                    return $this->respond($error);
                } else {
                    $this->mod->insert($data);
                }
            } else {
                $id = $this->request->getVar('id');
    
                if (!$this->validate($rules)) {
                    $error['populate'] = $data;
                    $error['errors'] = $this->validator->getErrors();
        
                    return $this->respond($error);
                } else {
                    $this->mod->update($id, $data);
                }
            }
        }
    }
