<table class="table table-responsive" id="accounts-table">
    <thead>
        <th>{!! trans('words.name') !!}</th>
        <th>{!! trans('words.client') !!}</th>
        <th>{!! trans('words.dominio') !!}</th>
        <th>{!! trans('words.category') !!}</th>
        <th colspan="3">{!! trans('words.action') !!}</th>
    </thead>
    <tbody>
    @foreach($accounts as $account)
        <tr>
            <td>{!! $account->name !!}</td>
            <td>{!! $account->clients->name !!}</td>
            <td>{!! $account->dominios->name !!}</td>
            <td>{!! $account->accountCategory->name !!}</td>
            <td>
                {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('accounts.show', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('accounts.edit', [$account->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans('phrases.areYouSure')."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>