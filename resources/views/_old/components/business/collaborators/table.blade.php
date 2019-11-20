<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($collaborators as $collaborator)
        <tr>
            <td>{{$collaborator->id}}</td>
            <td>{{$collaborator->name}}</td>
            <td>
                <a href="{{ route('collaborators.show',$collaborator->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('collaborators.edit',$collaborator->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('collaborators.destroy', $collaborator->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>