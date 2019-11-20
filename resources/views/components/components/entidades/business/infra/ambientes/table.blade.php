<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($ambientes as $ambiente)
        <tr>
            <td>{{$ambiente->id}}</td>
            <td>{{$ambiente->instance}}</td>
            <td>
                <a href="{{ route('ambientes.show',$ambiente->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('ambientes.edit',$ambiente->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('ambientes.destroy', $ambiente->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>