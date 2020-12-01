<html>

<head>

    <title>Список каталогов</title>

    @include('cmp.bootstrap')

</head>

<div class="m-3">

    <div class="d-flex flex-row ml-0 mb-2">
        <h4 class="mb-0">Список каталогов</h4>
        <a href="/catalogs/add" type="button" class="btn btn-primary btn-sm ml-2">Новый каталог</a>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Наименование каталога</th>
            </tr>
        </thead>
        <tbody>
            @if (count($list) > 0)
                @foreach ($list as $catalog)
                    <tr>
                        <th scope="row">{{ $catalog->catalog_id }}</th>
                        <td>{{ $catalog->catalog_title }}</td>
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
