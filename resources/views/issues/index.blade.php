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
    <h3 class="mb-3">Issues</h3>

    <div class="card">
        <div class="card-body">
            <div class="text-end">
                <a href="{{route('issues.create')}}" class="btn btn-primary mb-3">Add A New Issue</a>
            </div>
            <table id="issues" class="table" style="width:100%">
                <thead>
                    <th>Assigned Police Officer</th>
                    <th>Issue</th>
                    <th>Severity</th>
                    <td>Status</td>
                    <td>Actions</td>
                </thead>
                <tbody>
                    @foreach ($issues as $issue)
                    <tr>
                        <td>{{$issue->police->name}} {{$issue->police->surname}}</td>
                        <td>{{substr($issue->issue, 0, 50)}}...</td>
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
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-secondary me-3" href="{{route('issues.edit', $issue->id)}}">Edit</a>
                                <form action="{{route('issues.delete',$issue->id)}}" method="post">
                                    @csrf
                                    <button onclick="return confirm('Delete this issue?')" type="submit" class="btn btn-danger">Delete</button>
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
        $('#issues').DataTable();
    });
</script>
@endsection