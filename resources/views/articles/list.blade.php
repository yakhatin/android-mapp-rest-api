<html>

<head>

    <title>Список статей</title>

    @include('cmp.bootstrap')

    <link rel="stylesheet" href="/css/app.css" />

</head>

@include('cmp.header', ['page' => 'articles'])

<div class="m-3">

    <div class="d-flex flex-row ml-0 mb-2">
        <h4 class="mb-0">Список статей</h4>
        <a href="/articles/form" type="button" class="btn btn-primary btn-sm ml-2">Новая статья</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок статьи</th>
                <th scope="col">Каталог</th>
                <th scope="col">Текст статьи</th>
                <th scope="col" style="width: 100px;"></th>
            </tr>
        </thead>
        <tbody>
            @if (count($articles) > 0)
                @foreach ($articles as $article)
                    <tr>
                        <th scope="row">{{ $article->article_id }}</th>
                        <td>{{ $article->article_title }}</td>
                        <td>{{ $article->catalog->catalog_title }}</td>
                        <td>{{ $article->article_text }}</td>
                        <td>
                            <div class="d-flex flex-row align-items-start">
                                <a type="button" href="/articles/form/{{ $article->article_id }}"
                                    class="btn btn-sm btn-outline-info mr-2">
                                    <div class="edit-btn"></div>
                                </a>
                                <form method="GET" action="/articles/delete/{{ $article->article_id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <div class="delete-btn"></div>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th class="text-center p-5" colspan="4">Список пуст</th>
                </tr>
            @endif
        </tbody>
    </table>

</div>

</html>
