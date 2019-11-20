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
        @foreach($projects as $project)
        <tr>
            <td>{{$project->id}}</td>
            <td>{{$project->card_name}}</td>
            <td>{{$project->cpf}}</td>
            <td>{{$project->card_number}}</td>
            <td>{{$project->orders()->count()}}</td>
            <td>
                <a href="{{ route('projects.show',$project->id)}}" class="btn btn-primary">Show</a>
                <!--
                <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary">Edit</a>
                <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>-->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>