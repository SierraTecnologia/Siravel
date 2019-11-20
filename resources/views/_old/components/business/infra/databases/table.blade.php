<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($databases as $database)
        <tr>
            <td>{{$database->id}}</td>
            <td>{{$database->instance}}</td>
            <td>
                <a href="{{ route('databases.show',$database->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('databases.edit',$database->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('databases.destroy', $database->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>