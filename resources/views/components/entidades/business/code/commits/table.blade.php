<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($commits as $commit)
        <tr>
            <td>{{$commit->id}}</td>
            <td>{{$commit->instance}}</td>
            <td>
                <a href="{{ route('commits.show',$commit->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('commits.edit',$commit->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('commits.destroy', $commit->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>