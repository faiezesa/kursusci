<?php
    
    namespace App\Controllers;
    
    use App\Libraries\Secure;
    use CodeIgniter\RESTful\ResourceController;
    
    class APIEmployee extends ResourceController
    {
        public function __construct()
        {
            $this->mod = model('App\Models\EmployeeModel');
            $this->dam = model('App\Models\DeptAssignModel');
            $this->secure = new Secure();
        }
        
        public function listing()
        {
            helper('function');
            
            $filter['search'] = $this->request->getVar('search');
            $filter['limit'] = $this->request->getVar('limit');
            $filter['race'] = $this->request->getVar('race');
            $filter['religion'] = $this->request->getVar('religion');
            $filter['filter_name'] = $this->request->getVar('filter_name');
            $filter['filter_email'] = $this->request->getVar('filter_email');
            
            $page = $this->request->getVar('page');
            $limit = ($filter['limit']) ? $filter['limit'] : 10;
            $offset = pagingOffset($page, $limit);
            
            $employee = $this->mod->datatable($limit, $offset, $filter);
            
            $employee = array_map(function ($arr){
                $arr['secure_id'] = $this->secure->enc_session($arr['id']);
                return $arr;
            }, $employee);
            
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
        
        public function delete_data()
        {
            $id = $this->request->getVar('del');
            $id = $this->secure->dec_session($id);
            $this->mod->delete($id);
            $this->dam->where('emp_id', $id)->delete();
        }
        
        public function proses_data()
        {
            $proses = $this->request->getVar('act');
            
            $rules = [
                'name'     => 'required|max_length[255]',
                'email'    => 'required|valid_email',
                'icno'     => 'required|numeric',
                'religion' => 'required',
                'race'     => 'required'
            ];
            
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'icno'     => $this->request->getVar('icno'),
                'race'     => $this->request->getVar('race'),
                'religion' => $this->request->getVar('religion'),
            ];
            
            if ($proses == 'add') {
                if (!$this->validate($rules)) {
                    $error['populate'] = $data; //try populate data form
                    $error['errors'] = $this->validator->getErrors();
                    
                    return $this->respond($error);
                } else {
                    $this->mod->insert($data);
                }
            } else {
                $id = $this->request->getVar('id');
                $id = $this->secure->dec_session($id);
                
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
