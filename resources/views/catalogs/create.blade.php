<html>

<head>

    <title>Новый каталог</title>

    @include('cmp.bootstrap')

</head>

@include('cmp.header')

<div class="m-3">

    <h4>Новый каталог</h4>

    <form class="mt-4" method="GET" action="/catalogs/create">
        <div class=" form-group">
            <label for="catalog_title">Наименование каталога</label>
            <input class="form-control" id="catalog_title" name="catalog_title">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

</div>

</html>
