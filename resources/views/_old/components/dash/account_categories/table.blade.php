<table class="table table-responsive" id="accountCategories-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
    @foreach($accountCategories as $accountCategory)
        <tr>
            <td>{!! $accountCategory->name !!}</td>
            <td>
                {!! Form::open(['route' => ['accountCategories.destroy', $accountCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('accountCategories.show', [$accountCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('accountCategories.edit', [$accountCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>