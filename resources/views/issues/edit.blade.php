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
    <h3 class="mb-3">Edit this Issue</h3>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>

                <form action="{{route('issues.update',$issue->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        @if ($issue->user === null)
                        <label for="user_id" class="form-label">No Police Officer Assigned For This Issue, <span class="text-danger fw-bold">Select Below</span></label>
                        @else
                        <label for="user_id" class="form-label">Police Officer Assigned: <a href="{{route('users.edit', $issue->user->id)}}">({{$issue->getFullNameOfficer()}})</a></label>
                        @endif
                        <input class="form-select @error('user_id') is-invalid @enderror" list="officers" name="user_id" id="user_id" value="{{$issue->user_id}}">
                        <datalist id="officers">
                            <option value="">Remove The Assigned Officer</option>
                            @foreach ($officers as $officer)
                            <option selected value="{{$officer->id}}">{{$officer->name}} {{$officer->surname}}</option>
                            @endforeach
                        </datalist>
                        @error('user_id')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <!-- <label for="complainant" class="form-label">Complainant <a href="{{route('complainants.edit', $issue->complainant->id)}}">({{$issue->complainant->name}} {{$issue->complainant->middlename}} {{$issue->complainant->surname}}, {{$issue->complainant->gender}}, {{$issue->complainant->age}})</a></label> -->
                        <label for="complainant" class="form-label">Complainant <a href="{{route('complainants.edit', $issue->complainant->id)}}">({{$issue->getFullNameComplainant()}}, {{$issue->complainant->gender}}, {{$issue->complainant->age}})</a></label>

                        <input class="form-select @error('complainant_id') is-invalid @enderror" list="complainants" name="complainant_id" id="complainant_id" value="{{$issue->complainant_id}}">
                        <datalist id="complainants">
                            @foreach ($complainants as $complainant)
                            <option value="{{$complainant->id}}">{{$complainant->name}} {{$complainant->middlename}} {{$complainant->surname}} ({{$complainant->gender}}, {{$complainant->age}})</option>
                            @endforeach
                        </datalist>
                        @error('complainant_id')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="issue" class="form-label">Issue</label>
                        <textarea class="form-control @error('issue') is-invalid @enderror" name="issue" id="issue" rows="8">{{$issue->issue}}</textarea>
                        @error('issue')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="severity" class="form-label">Severity</label>
                        <select class="form-select @error('severity') is-invalid @enderror" name="severity" id="severity">
                            <option value="Normal" @if($issue->severity == 'Normal') selected @endif>Normal</option>
                            <option value="Severe" @if($issue->severity == 'Severe') selected @endif>Severe</option>
                            <option value="Critical" @if($issue->severity == 'Critical') selected @endif>Critical</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                            <option value="Open" @if($issue->status == 'Open') selected @endif>Open</option>
                            <option value="Processing" @if($issue->status == 'Processing') selected @endif>Processing</option>
                            <option value="Completed" @if($issue->status == 'Completed') selected @endif>Completed</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection