@extends('layouts.app')

@section('content')
@if(session()->has('deleted'))
<script>
    Swal.fire({
        icon: 'error',
        text: 'Police officer has been deleted',
    })
</script>
@endif
<div class="row justify-content-center">

    <h3 class="mb-3">Police Officers</h3>

    <div class="card">
        <div class="card-body">
            <div class="text-end">
                <a href="{{route('police.create')}}" class="btn btn-primary mb-3">Add A Police Officer</a>
            </div>
            <table id="police" class="table" style="width:100%">
                <thead>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($police_officers as $officer)
                    <tr>
                        <td><img class="img-fluid rounded" width="50" height="50" src="{{asset('images/'.$officer->photo)}}" alt="Photo"></td>
                        <td>{{$officer->name}}</td>
                        <td>{{$officer->surname}}</td>
                        <td>{{$officer->gender}}</td>
                        <td>{{$officer->phone}}</td>
                        <td>{{$officer->email}}</td>
                        <td>{{$officer->updated_at->format('M d, Y h:i A')}}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-secondary me-3" href="{{route('police.edit',$officer->id)}}">Edit</a>
                                <form action="{{route('police.delete',$officer->id)}}" method="post">
                                    @csrf
                                    <button onclick="return confirm('Delete this police officer?')" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#police').DataTable();
    });
</script>
@endsection