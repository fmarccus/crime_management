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
    @if (auth()->user()->user_type==0)
    <h3 class="mb-3">Incident Reports ({{$issues->count()}})</h3>
    @elseif(auth()->user()->user_type==1 || auth()->user()->user_type==2)
    <h3 class="mb-3">Incident Reports Assigned To You ({{$issues->count()}})</h3>
    @else
    <h3 class="mb-3">Incidents You Reported ({{$issues->count()}})</h3>
    @endif
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->user_type==0 || auth()->user()->user_type == 3)
            <div class="text-end">
                <a href="{{route('issues.create')}}" class="btn btn-primary mb-3">Add A New Incident Report</a>
            </div>
            @endif
            <div class="table-responsive">

                <table id="issues" class="table" style="width:100%">
                    <thead>
                    <th>ID</th>

                        <th>Assigned P.O.</th>
                        <th>Investigator</th>
                        <th>Complainant</th>
                        <th>Type</th>

                        <th>Incident Date</th>
                        <th>Date Created</th>
                        <th>Area</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Complete Date</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($issues as $issue)

                        <tr class="@if($issue->status=='Open') tb-bg-open @elseif($issue->status=='Processing') tb-bg-processing @else  @endif">
                        <td data-order="{{$issue->id}}" class="bg-light">INC-{{$issue->id}}</td>

                            <td>
                                @if ($issue->user === null)
                                <span class="fw-bold text-muted"> No Police Officer Assigned Yet</span>
                                @else
                                {{$issue->getFullNameOfficer()}}
                                @endif
                            </td>
                            <td>
                                @if ($issue->investigator === null)
                                <span class="fw-bold text-muted"> No Investigator Assigned Yet</span>
                                @else
                                {{$issue->getFullNameInvestigator()}}
                                @endif
                            </td>

                            <td>{{$issue->getFullNameComplainant()}}</td>
                            <td>{{$issue->type}}</td>

                            <td>{{$issue->date->format('M d, Y H:i:s A')}}</td>

                            <td>{{$issue->created_at->format('M d, Y H:i:s A')}}</td>

                            <td>{{$issue->area}}</td>
                            <td>
                                @if($issue->severity=='Normal')
                                <span class="badge rounded-pill text-bg-primary">
                                    {{$issue->severity}}
                                </span>
                                @elseif($issue->severity=='Severe')
                                <span class="badge rounded-pill text-bg-warning">
                                    {{$issue->severity}}
                                </span>
                                @else
                                <span class="badge rounded-pill text-bg-danger">
                                    {{$issue->severity}}
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($issue->status=='Open')
                                <span class="badge rounded-pill text-bg-light">
                                    {{$issue->status}}
                                </span>
                                @elseif($issue->status=='Processing')
                                <span class="badge rounded-pill text-bg-info">
                                    {{$issue->status}}
                                </span>
                                @else
                                <span class="badge rounded-pill text-bg-success">
                                    {{$issue->status}}
                                </span>
                                @endif
                            </td>
                            <td> @if($issue->status == "Completed"){{$issue->updated_at->format('M d, Y H:i:s A')}} @else Not Yet Completed @endif</td>

                            <td>
                                @if (auth()->user()->user_type==0)

                                <div class="d-flex">
                                    <a class="btn btn-secondary me-3" href="{{route('issues.edit', $issue->id)}}">Edit</a>
                                    <form action="{{route('issues.delete',$issue->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Delete this issue?')" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                @else
                                <a class="btn btn-light me-3" href="{{route('issues.view', $issue->id)}}">View</a>

                                @endif

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

        var table = $('#issues').DataTable({
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