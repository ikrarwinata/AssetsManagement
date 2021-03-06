<?php
namespace App\Models;
/**
* Auto Generated By TrigerIgniter v1
* Codeigniter Version 4.1.x
* Codeigniter Model
**/

use CodeIgniter\Model;

class Company_model extends Model
{
    protected $table      = 'company';
    protected $primaryKey = 'index_key';

    //To help protect against Mass Assignment Attacks, the Model class requires 
    //that you list all of the field names that can be changed during inserts and updates
    // https://codeigniter4.github.io/userguide/models/model.html#protecting-fields
    protected $allowedFields = ['index_key', 'com_value', 'com_text'];

    protected $useAutoIncrement = false;

    // protected $returnType     = 'array';
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public $order = "DESC";
    public $columnIndex = "index_key";

    public function getFields(){
        return $this->allowedFields;
    }

    public function getKeys()
    {
        $temp = [];
        $load = $this->findAll();
        foreach ($load as $key => $value) {
            $temp[] = $value->index_key;
        };
        return $temp;
    }

    public function getById($id)
    {
        return $this->where($this->primaryKey, $id)->sort()->first();
    }

    public function getRowBy($key, $val)
    {
        return $this->where($key, $val)->sort()->first();
    }

    public function getBy($key, $val)
    {
        return $this->where($key, $val)->sort()->findAll();
    }

    public function totalRows($arr = NULL)
    {
        if ($arr == NULL) {
            return $this->countAllResults();
        }else{
            if(is_array($arr)) {
                foreach ($arr as $key => $value) {
                    $this->where($key, $value);
                };
            }else{
                $this->getData($arr);
            }
            return $this->countAllResults();
        }
    }

    public function getData($keyword = null)
    {
        if ($keyword == null) {
            return $this->sort();
        };
        $this
            ->groupStart()
            ->like($this->table . '.index_key', $keyword)
            ->orLike($this->table . '.com_value', $keyword)
            ->orLike($this->table . '.com_text', $keyword)
            ->groupEnd();
        return $this->sort();
    }

    public function sort($columnIndex = NULL, $sortDirection = NULL)
    {
        if($columnIndex == NULL){
            if (strpos($this->columnIndex, ".") !== FALSE) {
                $columnIndex = $this->columnIndex;
            }else{
                $columnIndex = $this->table . '.' . $this->columnIndex;
            }
        };
        if($sortDirection == NULL){
            $sortDirection = $this->order;
        };
        return $this->orderBy($columnIndex, $sortDirection);
    }

    public function truncate(){
        $this->query('TRUNCATE '.$this->table);
        return TRUE;
    }
    
    //END_PHPSPREADSHEET_FUNCTION
}
