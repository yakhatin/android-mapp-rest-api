<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->table = 'articles';
        $this->primaryKey = 'article_id';
    }

    protected $fillable = [
        'article_title',
        'article_text',
        'catalog_id',
        'user_id'
    ];

    protected $visible = [
        'article_id',
        'article_title',
        'article_text',
        'catalog_id',
        'user_id'
    ];
}