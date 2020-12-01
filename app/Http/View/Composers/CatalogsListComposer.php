<?php

namespace App\Http\View\Composers;

use App\Models\Catalogs;
use Illuminate\View\View;

class CatalogsListComposer
{
    private $list;

    private function getCatalogsList()
    {
        $model = new Catalogs();

        return $model->all();
    }

    public function __construct()
    {
        $this->list = $this->getCatalogsList();
    }

    public function compose(View $view)
    {
        $view->with('list', $this->list);
    }
}