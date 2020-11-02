<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogs extends Model
{
    use HasFactory;

    public function __construct()
    {
        $this->table = 'catalogs';
        $this->primaryKey = 'catalog_id';
    }

    protected $fillable = [
        'catalog_title',
        'catalog_description'
    ];

    protected $visible = [
        'catalog_id',
        'catalog_title',
        'catalog_description'
    ];
}