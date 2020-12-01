<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item{{ isset($page) && $page == 'articles' ? ' active' : '' }}">
                <a class="nav-link" href="/articles/list">Список статей<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item{{ isset($page) && $page == 'catalogs' ? ' active' : '' }}">
                <a class="nav-link" href="/catalogs/list">Список каталогов</a>
            </li>
        </ul>
    </div>
</nav>
