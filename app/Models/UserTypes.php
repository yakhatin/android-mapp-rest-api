<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->table = 'user_types';
        $this->primaryKey = 'user_type_id';
    }
}