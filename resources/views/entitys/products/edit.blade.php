@extends('siravel::layouts.dashboard')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ Siravel::moduleAsset('siravel', 'css/store.css', 'text/css') }}">
@stop

@section('pageTitle') Products @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('siravel::products.breadcrumbs', ['location' => ['edit']])

        @include('siravel::products.tabs', $tabs)
    </div>

@endsection

@section('javascript')

    @parent

    <script type="text/javascript" >
        $(document).ready(function(){
            $('.variant-row').each(function(){
                var _variant = $(this).data('variant');
                var _row = $(this);
                $(this).children('td').children('.save-variant').click(function(){
                    var _key = _row.children('td').children('.key').val();
                    var _value = _row.children('td').children('.value').val();
                    $.ajax({
                        type: "POST",
                        url: _url+"/admin/products/variant/save",
                        data: {
                            _token: _token,
                            id: _variant,
                            key: _key,
                            value: _value
                        },
                        cache: false,
                        dataType: "html",
                        success: function(data){
                            siravelNotify('Your variant was saved', 'alert-success')
                        }
                    });
                });

                $(this).children('td').children('.delete-variant').click(function(){
                    $.ajax({
                        type: "POST",
                        url: _url+"/admin/products/variant/delete",
                        data: { id: _variant, _token: _token },
                        cache: false,
                        dataType: "html",
                        success: function(data){
                            siravelNotify('Your variant was deleted', 'alert-success')
                            _row.remove();
                        }
                    });
                });
            });
        });
    </script>

@endsection
