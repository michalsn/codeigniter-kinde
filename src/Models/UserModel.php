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
    protected $allowedFields    = ['identity', 'first_name', 'last_name', 'email', 'last_login_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function findByIdentity(string $identity)
    {
        return $this->where('identity', $identity)->first();
    }

    public function updateByIdentity(string $identity, array $data)
    {
        return $this->where('identity', $identity)->set($data)->update();
    }
}
