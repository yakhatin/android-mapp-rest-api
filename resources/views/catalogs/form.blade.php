<html>

<head>

    <title>{{ $form_title }}</title>

    @include('cmp.bootstrap')

</head>

@include('cmp.header')

<div class="m-3">

    <h4>{{ $form_title }}</h4>

    <form class="mt-4" method="GET"
        action="{{ $editMode ? '/catalogs/edit/' . $data->catalog_id : '/catalogs/create' }}">
        <div class=" form-group">
            <label for="catalog_title">Наименование каталога</label>
            <input class="form-control" id="catalog_title" name="catalog_title"
                value="{{ $editMode ? $data->catalog_title : '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

</div>

</html>
