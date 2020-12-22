<?php

namespace App\Http\View\Composers;

use App\Models\Article;
use App\Models\Catalogs;
use Illuminate\View\View;

class ArticleFormComposer
{
    private $form_title = 'Новая статья';
    private $data;
    private $catalogs;

    private function getArticleData()
    {
        $model = new Article();
        $q = $model->newQuery();

        return $q->find(request()->id);
    }

    private function getCatalogsList()
    {
        $model = new Catalogs();

        return $model->all();
    }

    public function __construct()
    {
        $editMode = gettype(request()->id) === 'string';

        $this->catalogs = $this->getCatalogsList();

        if ($editMode) {
            $this->data = $this->getArticleData();
            $this->form_title = 'Редактирование';
        }
    }

    public function compose(View $view)
    {
        $view->with('form_title', $this->form_title);
        $view->with('data', $this->data);
        $view->with('editMode', gettype($this->data) === 'object');
        $view->with('catalogs', $this->catalogs);
    }
}