<?php

namespace App\Http\Controllers;

use App\Models\Catalogs;
use App\Http\Requests\CatalogRequest;

class CatalogController extends ApiController
{
    public function __construct(Catalogs $model, CatalogRequest $request)
    {
        $this->model = $model;
        $this->request = $request;

        $this->accessLevels['create'] = 300;
        $this->accessLevels['update'] = 300;
        $this->accessLevels['delete'] = 300;
    }
}