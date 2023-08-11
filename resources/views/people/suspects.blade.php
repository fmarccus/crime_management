@extends('layouts.app')

@section('content')
@if(session()->has('deleted'))
<script>
    Swal.fire({
        icon: 'error',
        text: 'Issue has been deleted',
    })
</script>
@endif
<div class="row justify-content-center">

    <h3 class="mb-3">Suspects ({{$people->count()}})</h3>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="people" class="table" style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Identification</th>
                        <th>Incident Report #</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Contact</th>
                    </thead>
                    <tbody>
                        @foreach ($people as $person)
                        <tr>
                            <td data-order="{{$person->id}}" class="bg-light">SUS-{{$person->id}}</td>

                            <td> @if ($person->identification)
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/' . $person->identification) }}" alt="User Photo">
                                @else
                                <img class="img-fluid rounded" width="30" height="30" src="{{ asset('images/user.png') }}" alt="Default User Photo">
                                @endif
                            </td>
                            @if(auth()->user()->user_type == 1 || auth()->user()->user_type == 2)
                            <td data-order="{{$person->issue_id}}"><a href="{{route('issues.view', $person->issue_id)}}">INC-{{$person->issue_id}}</a></td>
                            @elseif(auth()->user()->user_type == 3)
                            <td data-order="{{$person->issue_id}}"><a href="{{route('issues.edit', $person->issue_id)}}">INC-{{$person->issue_id}}</a></td>
                            @endif
                            <td>{{$person->person_name}}</td>
                            <td>{{$person->gender}}</td>
                            <td>{{$person->contact}}</td>

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

        var table = $('#people').DataTable({
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