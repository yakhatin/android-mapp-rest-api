<?php

namespace App\Http\View\Composers;

use App\Models\Catalogs;
use Illuminate\View\View;

class CatalogFormComposer
{
    private $form_title = 'Новый каталог';
    private $data;

    private function getCatalogData()
    {
        $model = new Catalogs();
        $q = $model->newQuery();

        return $q->find(request()->id);
    }

    public function __construct()
    {
        $editMode = gettype(request()->id) === 'string';

        if ($editMode) {
            $this->data = $this->getCatalogData();
            $this->form_title = 'Редактирование';
        }
    }

    public function compose(View $view)
    {
        $view->with('form_title', $this->form_title);
        $view->with('data', $this->data);
        $view->with('editMode', gettype($this->data) === 'object');
    }
}