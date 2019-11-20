<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Instance</td>
            <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($languages as $language)
        <tr>
            <td>{{$language->id}}</td>
            <td>{{$language->instance}}</td>
            <td>
                <a href="{{ route('languages.show',$language->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('languages.edit',$language->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('languages.destroy', $language->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>