<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username', 'email', 'password_hash', 'full_name', 'phone', 'age', 'gender', 'address', 'profile_pic', 'role'
    ];

    protected $useTimestamps = true;

    // Remove password hashing hooks here because we're handling it manually in controller
}
