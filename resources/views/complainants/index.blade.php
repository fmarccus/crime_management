@extends('layouts.app')

@section('content')
@if(session()->has('deleted'))
<script>
    Swal.fire({
        icon: 'error',
        text: 'Complainant has been deleted',
    })
</script>
@endif
<div class="row justify-content-center">
    <h3 class="mb-3">Complainants</h3>
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->user_type==0)
            <div class="text-end">
                <a href="{{route('complainants.create')}}" class="btn btn-primary mb-3">Add A New Complainant</a>
            </div>

            @endif
            <div class="table-responsive">

                <table id="complainants" class="table" style="width:100%">
                    <thead>
                        <th>Name</th>
                        <th>Middle</th>
                        <th>Last</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>

                    </thead>
                    <tbody>
                        @foreach ($complainants as $complainant)
                        <tr>
                            <td>{{$complainant->name}}</td>
                            <td>{{$complainant->middlename}}</td>
                            <td>{{$complainant->surname}}</td>
                            <td>{{$complainant->age}}</td>
                            <td>{{$complainant->gender}}</td>
                            <td>{{$complainant->phone}}</td>
                            <td>{{$complainant->address}}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-secondary me-3" href="{{route('complainants.edit', $complainant->id)}}">Edit</a>
                                    <form action="{{route('complainants.delete',$complainant->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Delete this complainant?')" type="submit" class="btn btn-danger">Delete</button>
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
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#complainants').DataTable();
    });
</script>
@endsection