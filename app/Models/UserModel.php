<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'phone',
        'age',
        'gender',
        'address',
        'profile_pic',
        'role',  
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;  // works if you have created_at & updated_at
}
