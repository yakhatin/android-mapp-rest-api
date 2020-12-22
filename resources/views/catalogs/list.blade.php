<html>

<head>

    <title>Список каталогов</title>

    @include('cmp.bootstrap')

    <link rel="stylesheet" href="/css/app.css" />

</head>

@include('cmp.header', ['page' => 'catalogs'])

<div class="m-3">

    <div class="d-flex flex-row ml-0 mb-2">
        <h4 class="mb-0">Список каталогов</h4>
        <a href="/catalogs/form" type="button" class="btn btn-primary btn-sm ml-2">Новый каталог</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование каталога</th>
                <th scope="col" style="width: 100px;"></th>
            </tr>
        </thead>
        <tbody>
            @if (count($catalogs) > 0)
                @foreach ($catalogs as $catalog)
                    <tr>
                        <th scope="row">{{ $catalog->catalog_id }}</th>
                        <td>{{ $catalog->catalog_title }}</td>
                        <td>
                            <div class="d-flex flex-row align-items-start">
                                <a type="button" href="/catalogs/form/{{ $catalog->catalog_id }}"
                                    class="btn btn-sm btn-outline-info mr-2">
                                    <div class="edit-btn"></div>
                                </a>
                                <form method="GET" action="/catalogs/delete/{{ $catalog->catalog_id }}">
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
                    <th class="text-center p-5" colspan="2">Список пуст</th>
                </tr>
            @endif
        </tbody>
    </table>

</div>

</html>
