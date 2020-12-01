<html>

<head>

    <title>Список статей</title>

    @include('cmp.bootstrap')

</head>

@include('cmp.header', ['page' => 'articles'])

<div class="m-3">

    <div class="d-flex flex-row ml-0 mb-2">
        <h4 class="mb-0">Список статей</h4>
        <a href="/articles/add" type="button" class="btn btn-primary btn-sm ml-2">Новая статья</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок статьи</th>
                <th scope="col">Каталог</th>
                <th scope="col">Текст статьи</th>
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
                    </tr>
                @endforeach
            @else
                <tr>
                    <th class="text-center p-5" colspan="2">Список пуст</th>
                </tr>
            @endif
        </tbody>
    </table>

</div>

</html>
