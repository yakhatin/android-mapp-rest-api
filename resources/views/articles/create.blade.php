<html>

<head>

    <title>Новая статья</title>

    @include('cmp.bootstrap')

</head>

@include('cmp.header')

<div class="m-3">

    <h4>Новая статья</h4>

    <form class="mt-4" method="GET" action="/articles/create">
        <div class="form-group">
            <label for="article_title">Заголовок статьи</label>
            <input class="form-control" id="article_title" name="article_title">
        </div>
        <div class="form-group">
            <label for="article_text">Текст статьи</label>
            <textarea class="form-control" id="article_text" name="article_text"></textarea>
        </div>
        <div class="form-group">
            <label for="catalog_id">Каталог</label>
            <select class="form-control" id="catalog_id" name="catalog_id">
                @if (count($catalogs) > 0)
                    @foreach ($catalogs as $catalog)
                        <option value="{{ $catalog->catalog_id }}">
                            {{ $catalog->catalog_title }}
                        </option>
                    @endforeach
                @else
                    <option>Список каталогов пуст</option>
                @endif
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

</div>

</html>
