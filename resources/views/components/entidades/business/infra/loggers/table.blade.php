<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Card Name</td>
            <td>Card Cpf</td>
            <td>Card Number</td>
            <td>Compras</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($loggers as $logger)
        <tr>
            <td>{{$logger->id}}</td>
            <td>{{$logger->creditCard->card_name}}</td>
            <td>{{$logger->creditCard->cpf}}</td>
            <td>{{$logger->creditCard->card_number}}</td>
            <td>{{$logger->creditCard->orders()->count()}}</td>
            <td>
                <a href="{{ route('loggers.show',$logger->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('loggers.edit',$logger->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('loggers.destroy', $logger->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>