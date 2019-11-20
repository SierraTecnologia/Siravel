<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($databaseCollections as $databaseCollection)
        <tr>
            <td>{{$databaseCollection->id}}</td>
            <td>{{$databaseCollection->instance}}</td>
            <td>
                <a href="{{ route('databaseCollections.show',$databaseCollection->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('databaseCollections.edit',$databaseCollection->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('databaseCollections.destroy', $databaseCollection->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>