<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! cms()->url('transactions') !!}">Transactions</a></li>
            {!! Siravel::breadcrumbs($location) !!}
        <li class="active"></li>
    </ol>
</nav>