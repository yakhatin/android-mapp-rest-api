<?php

namespace App\Http\Controllers;

use App\Models\Catalogs;
use App\Http\Requests\CatalogRequest;

class CatalogsController extends ApiController
{
    public function __construct(Catalogs $model, CatalogRequest $request)
    {
        $this->model = $model;
        $this->request = $request;
    }
}