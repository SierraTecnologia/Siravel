<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{$service->id}}</td>
            <td>{{$service->instance}}</td>
            <td>
                <a href="{{ route('services.show',$service->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('services.edit',$service->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('services.destroy', $service->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>