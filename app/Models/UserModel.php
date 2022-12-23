<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["user_name", "email", "password", "phone_number", "address"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

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

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    // Check if user has exist
    public function checkUser($column, $data)
    {
        $q = $this->db->table($this->table)->where($column, $data)->get()->getFirstRow();
        return $q;
    }

    // Check if user has exist
    public function checkUserWithoutSession($column, $data)
    {
        $q = $this->db->table($this->table)->where(array($column => $data, "id_user !=" => session()->id))->get()->getFirstRow();
        return $q;
    }

    // Get user data logged in
    public function getUserProfile()
    {
        $q = $this->db->table($this->table)->where("email", session()->email)->get()->getFirstRow();
        return $q;
    }
}
