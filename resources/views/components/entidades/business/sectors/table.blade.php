<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($sectors as $sector)
        <tr>
            <td>{{$sector->id}}</td>
            <td>{{$sector->instance}}</td>
            <td>
                <a href="{{ route('sectors.show',$sector->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('sectors.edit',$sector->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('sectors.destroy', $sector->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>