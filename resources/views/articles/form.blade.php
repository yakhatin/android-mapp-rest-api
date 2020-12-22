<html>

<head>

    <title>{{ $form_title }}</title>

    @include('cmp.bootstrap')

</head>

@include('cmp.header')

<div class="m-3">

    <h4>{{ $form_title }}</h4>

    <form class="mt-4" method="GET"
        action="{{ $editMode ? '/articles/edit/' . $data->article_id : '/articles/create' }}">
        <div class="form-group">
            <label for="article_title">Заголовок статьи</label>
            <input class="form-control" id="article_title" name="article_title"
                value="{{ $editMode ? $data->article_title : '' }}">
        </div>
        <div class="form-group">
            <label for="article_text">Текст статьи</label>
            <textarea class="form-control" id="article_text"
                name="article_text">{{ $editMode ? $data->article_text : '' }}</textarea>
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
