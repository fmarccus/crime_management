@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'Issue has been updated',
    })
</script>
@endif
<div class="row">
    <h3 class="mb-3">Issue Information</h3>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>
                <p class="card-title">Complainant</p>
                <!-- {{$issue->complainant}} -->
                <p><span class="fw-bold">Name:</span> {{$issue->getFullNameComplainant()}}</p>
                <p><span class="fw-bold">Age:</span> {{$issue->complainant->age}}</p>
                <p><span class="fw-bold">Gender:</span> {{$issue->complainant->gender}}</p>
                <p><span class="fw-bold">Phone:</span> {{$issue->complainant->phone}}</p>
                <p><span class="fw-bold">Email:</span> {{$issue->complainant->email}}</p>
                <p><span class="fw-bold">Address:</span> {{$issue->complainant->address}}</p>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="card-title">Issue/Complaint Information</p>

                <div class="mb-3">
                    <label for="issue" class="form-label">Issue</label>
                    <textarea class="form-control @error('issue') is-invalid @enderror" name="issue" id="issue" rows="8" disabled>{{$issue->issue}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date of Incident</label>

                    <p>{{$issue->date->format('M d, Y H:i:s A')}}</p>

                </div>
                <div class="mb-3">
                    <label for="severity" class="form-label">Severity</label>
                    <br>
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
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <br>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection