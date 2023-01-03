<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = "id_user";
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'slug_user', 'username', 'email', 'password'];

    public function getUsers($username = '', $slug = '')
    {
        if ($username) {
            return $this->where('username', $username)->first();
        }

        if ($slug) {
            return $this->where('slug_user', $slug)->first();
        }

        return $this->findAll();
    }
}
