<?php

namespace App\Http\View\Composers;

use App\Models\Article;
use Illuminate\View\View;

class ArticlesListComposer
{
    private $list;

    private function getArticlesList()
    {
        $model = new Article();

        return $model->all();
    }

    public function __construct()
    {
        $this->list = $this->getArticlesList();
    }

    public function compose(View $view)
    {
        $view->with('articles', $this->list);
    }
}