<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    public function __construct(Article $model, ArticleRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->created_by_user_column = 'user_id';

        $this->accessLevels['create'] = 200;
        $this->accessLevels['update'] = 200;
        $this->accessLevels['delete'] = 300;
    }

    public function createFromWeb(Request $request)
    {
        $validated = $request->validate($this->request->rules, $this->request->messages());

        if ($validated) {
            $validated[$this->created_by_user_column] = 1;

            $row = $this->model;
            $row->fill($validated);
            $created = $row->save();

            if ($created) {
                return redirect('/articles/list');
            }
        }
    }
}