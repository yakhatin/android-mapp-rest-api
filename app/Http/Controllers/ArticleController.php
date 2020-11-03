<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;

class ArticleController extends ApiController
{
    public function __construct(Article $model, ArticleRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->created_by_user_column = 'user_id';
    }
}