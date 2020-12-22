<?php

namespace App\Http\Controllers;

use App\Models\Catalogs;
use App\Http\Requests\CatalogRequest;
use Illuminate\Http\Request;

class CatalogController extends ApiController
{
    public function __construct(Catalogs $model, CatalogRequest $request)
    {
        $this->model = $model;
        $this->request = $request;

        $this->accessLevels['create'] = 0;
        $this->accessLevels['update'] = 300;
        $this->accessLevels['delete'] = 300;
    }

    public function createFromWeb(Request $request)
    {
        $validated = $request->validate($this->request->rules, $this->request->messages());

        if ($validated) {
            $row = $this->model;
            $row->fill($validated);
            $created = $row->save();

            if ($created) {
                return redirect('/catalogs/list');
            }
        }
    }

    public function editFromWeb(Request $request)
    {
        $entity = $this->model->find($request->id);

        if ($entity) {
            $data = $request->validate($this->request->updateRules, $this->request->messages());

            $entity->fill($data)->save();
        }

        return redirect('/catalogs/form/' . $request->id);
    }

    public function deleteFromWeb($entityId)
    {
        $entity = $this->model->find($entityId);

        if (!$entity) {
            return $this->sendError('Запись не найдена', 404);
        }

        $entity->delete();

        return redirect('/catalogs/list');
    }
}