<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! url('admin/'.'blog') !!}">Blog</a></li>
            {!! Siravel::breadcrumbs($location) !!}
        <li class="active"></li>
    </ol>
</nav>