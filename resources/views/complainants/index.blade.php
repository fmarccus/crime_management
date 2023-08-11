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

    <h3 class="mb-3">Complainants ({{$complainants->count()}})</h3>

    <div class="card">
        <div class="card-body">
            <div class="text-end">
            </div>
            <div class="table-responsive">
                <table id="users" class="table" style="width:100%">
                    <thead>
                    <th>ID</th>

                        <th>Photo</th>
                        <th>Gender</th>
                        <th>Full Name</th>
                        <th>Acc Type</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Last Updated</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($complainants as $user)
                        <tr>
                        <td data-order="{{$user->id}}" class="bg-light">COM-{{$user->id}}</td>

                            <td>
                                @if ($user->photo)
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/' . $user->photo) }}" alt="User Photo">
                                @else
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/user.png') }}" alt="Default User Photo">
                                @endif
                            </td>
                            <td>{{$user->gender}}</td>
                            <td>{{$user->name}} {{$user->surname}}</td>
                            <td>
                                @if($user->user_type=='0')
                                <span class="badge rounded-pill text-bg-primary">
                                    Master
                                </span>
                                @elseif($user->user_type=='1')
                                <span class="badge rounded-pill text-bg-info">
                                    Police Officer
                                </span>
                                @elseif($user->user_type=='2')
                                <span class="badge rounded-pill text-bg-warning">
                                    Investigator
                                </span>
                                @else
                                <span class="badge rounded-pill text-bg-danger">
                                    Complainant
                                </span>
                                @endif
                            </td>
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
        var table = $('#users').DataTable({
            "columnDefs": [{
                "type": "numeric",
                "targets": "ID"
            }],
            dom: 'Bfrtip',
            stateSave: true,
            colReorder: true,
            buttons: [{
                    extend: 'copy',
                    split: [
                        'print',
                        'excel',
                        'csv',
                        'pdf',
                    ]
                },
                {
                    extend: 'colvis',
                    postfixButtons: ['colvisRestore'],
                    columnText: function(dt, idx, title) {
                        return (idx + 1) + '. ' + title;
                    }
                },
            ]
        });
    });
</script>
@endsection