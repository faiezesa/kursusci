<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class EmployeeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'employee';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->db = db_connect();
    }
    
    public function datatable($limit, $offset, $filter){
        $db = $this->db->table('employee');
        $db->select('employee.id, employee.name, employee.icno, employee.email, employee.race as race_code, employee.religion as religion_code');
        $db->select('race.race, religion.religion');
        $db->join('dept_assign','employee.id = dept_assign.emp_id','left');
        $db->join('department','department.id = dept_assign.dept_id','left');
        $db->join('race','race.code = employee.race','left');
        $db->join('religion','religion.code = employee.religion','left');
        if($filter['search']){
            $db->like('LOWER(employee.name)',strtolower($filter['search']))
                ->orLike('LOWER(employee.icno)', strtolower($filter['search']))
                ->orLike('LOWER(employee.email)', strtolower($filter['search']));
        }
        if($filter['race']){
            $db->where('employee.race',$filter['race']);
        }
        if($filter['religion']){
            $db->where('employee.religion',$filter['religion']);
        }
        if($filter['filter_name']){
            $db->like('employee.name',$filter['filter_name']);
        }
        if($filter['filter_email']){
            $db->like('employee.email',$filter['filter_email']);
        }
        $db->orderBy('employee.name');
        $db->limit($limit, $offset);
        $data = $db->get();
        if($data){
            return $data->getResultArray();
        }else{
            return null;
        }
    }
    
    public function datacount($filter){
        $db = $this->db->table('employee');
        $db->join('dept_assign','employee.id = dept_assign.emp_id','left');
        $db->join('department','department.id = dept_assign.dept_id','left');
        if($filter['search']){
            $db->like('LOWER(employee.name)',strtolower($filter['search']))
                ->orLike('LOWER(employee.icno)', strtolower($filter['search']))
                ->orLike('LOWER(employee.email)', strtolower($filter['search']));
        }
        if($filter['race']){
            $db->where('employee.race',$filter['race']);
        }
        if($filter['religion']){
            $db->where('employee.religion',$filter['religion']);
        }
        if($filter['filter_name']){
            $db->like('employee.name',$filter['filter_name']);
        }
        if($filter['filter_email']){
            $db->like('employee.email',$filter['filter_email']);
        }
        $db->where('employee.deleted_at is null'); //if using soft delete
        $count = $db->countAllResults();
        if($count){
            return $count;
        }else{
            return null;
        }
    }
}
