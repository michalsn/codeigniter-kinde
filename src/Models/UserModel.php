<?php

namespace Michalsn\CodeIgniterKinde\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kinde_id', 'first_name', 'last_name', 'email', 'last_login_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findByKindeId(string $kindeId)
    {
        return $this->where('kinde_id', $kindeId)->first();
    }

    public function updateByKindeId(string $kindeId, array $data)
    {
        return $this->where('kinde_id', $kindeId)->set($data)->update();
    }
}
