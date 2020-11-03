<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaryRequest;
use App\Models\Commentary;

class CommentaryController extends ApiController
{
    public function __construct(Commentary $model, CommentaryRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
        $this->created_by_user_column = 'user_id';
    }
}