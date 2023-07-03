@extends('layouts.app')

@section('content')
@if(session()->has('deleted'))
<script>
    Swal.fire({
        icon: 'error',
        text: 'User has been deleted',
    })
</script>
@elseif(session()->has('unable'))
<script>
    Swal.fire({
        icon: 'error',
        text: 'You cannot delete this police officer. He/she has is assigned into a complaint.',
    })
</script>
@endif
<div class="row justify-content-center">

    <h3 class="mb-3">User Management</h3>

    <div class="card">
        <div class="card-body">
            <div class="text-end">
                <a href="{{route('users.create')}}" class="btn btn-primary mb-3">Add A New User</a>
            </div>
            <div class="table-responsive">
                <table id="users" class="table" style="width:100%">
                    <thead>
                        <th>Photo</th>
                        <th>Gender</th>
                        <th>Full Name</th>
                        <th>Rank</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                @if ($user->photo)
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/' . $user->photo) }}" alt="User Photo">
                                @else
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/user.png') }}" alt="Default User Photo">
                                @endif
                            </td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->name}} {{$user->surname}}</td>
                            <td>{{$user->rank}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->updated_at->format('M d, Y h:i A')}}</td>

                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-secondary me-3" href="{{route('users.edit',$user->id)}}">Edit</a>
                                    <form action="{{route('users.delete',$user->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Delete this user account?')" type="submit" class="btn btn-danger">Delete</button>
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
        $('#users').DataTable();
    });
</script>
@endsection