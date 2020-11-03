<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->table = 'commentaries';
        $this->primaryKey = 'comment_id';
    }

    protected $fillable = [
        'comment_text',
        'article_id',
        'user_id'
    ];

    protected $visible = [
        'comment_id',
        'comment_text',
        'article_id',
        'user_id'
    ];
}