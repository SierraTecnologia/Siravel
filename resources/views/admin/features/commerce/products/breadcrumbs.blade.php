<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! siravel()->url('products') !!}">Products</a></li>
            {!! Siravel::breadcrumbs($location) !!}
        <li class="active"></li>
    </ol>
</nav>