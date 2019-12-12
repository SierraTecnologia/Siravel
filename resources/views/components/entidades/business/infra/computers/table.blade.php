<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($computers as $computer)
        <tr>
            <td>{{$computer->id}}</td>
            <td>{{$computer->instance}}</td>
            <td>
                <a href="{{ route('computers.show',$computer->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('computers.edit',$computer->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('computers.destroy', $computer->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>