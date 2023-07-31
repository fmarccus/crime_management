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
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="{{route('issues.index')}}" class="btn btn-light me-1">Back</a>

    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Complainant</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Incident Report</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Dispatched Personnels</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-evidences-tab" data-bs-toggle="pill" data-bs-target="#pills-evidences" type="button" role="tab" aria-controls="pills-evidences" aria-selected="false">Evidences</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-progress-tab" data-bs-toggle="pill" data-bs-target="#pills-progress" type="button" role="tab" aria-controls="pills-progress" aria-selected="false">Progress Tracking <span class="badge rounded-pill text-bg-warning">{{$progresses->count()}}</span></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-suspects-tab" data-bs-toggle="pill" data-bs-target="#pills-suspects" type="button" role="tab" aria-controls="pills-suspects" aria-selected="false"> Suspects & Witnesses <span class="badge rounded-pill text-bg-danger">{{$issue->persons->count()}}</span></button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="card mb-3">
            <div class="card-body">
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
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-title">Incident Report</p>

                <div class="mb-3">
                    {!! $issue->issue !!}
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
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Police Officer</h4>
                @if($issue->user === null)
                <span class="fw-bold text-muted"> No Police Officer Assigned Yet</span>

                @else
                <p><span class="fw-bold">Name:</span> {{$issue->getFullNameOfficer()}}</p>
                <p><span class="fw-bold">Gender:</span> {{$issue->user->gender}}</p>
                <p><span class="fw-bold">Phone:</span> {{$issue->user->phone}}</p>
                <p><span class="fw-bold">Email:</span> {{$issue->user->email}}</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Investigator</h4>
                @if($issue->user === null)
                <span class="fw-bold text-muted"> No Investigator Assigned Yet</span>
                @else
                <p><span class="fw-bold">Name:</span> {{$issue->getFullNameInvestigator()}}</p>
                <p><span class="fw-bold">Gender:</span> {{$issue->investigator->gender}}</p>
                <p><span class="fw-bold">Phone:</span> {{$issue->investigator->phone}}</p>
                <p><span class="fw-bold">Email:</span> {{$issue->investigator->email}}</p>
                @endif

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="pills-suspects" role="tabpanel" aria-labelledby="pills-suspects-tab" tabindex="0">
        <div class="row">
            @foreach ($issue->persons as $person)
            <div class="col-sm-6 mb-3">
                <div class="card border-start @if($person->person_type == 'witness') border-primary  @else border-danger @endif">
                    <div class="card-body">
                        @if($person->identification == NULL)
                        <img class="img-fluid mb-3" height=100 width=100 src="{{asset('images/user.png')}}" alt="" srcset="">
                        @else
                        <img class="img-fluid mb-3" height=100 width=100 src="{{asset('images/'. $person->identification)}}" alt="" srcset="">

                        @endif
                        <div class="row">
                            <div class="col-sm-6 mb-3">

                                <p class="card-title">Status</p>
                                @if($person->person_type == "witness")
                                <span class="badge rounded-pill text-bg-primary">Witness</span>
                                @else
                                <span class="badge rounded-pill text-bg-danger">Suspect</span>
                                @endif
                                <p class="mt-3 card-title">Name</p>
                                <p>{{$person->person_name}}</p>
                                <p class="card-title">Gender</p>
                                <p>{{$person->gender}}</p>
                                <p class="card-title">Date of Birth</p>
                                <p>{{$person->dob}}</p>
                                <p class="card-title">Address</p>
                                <p>{{$person->address}}</p>
                                <p class="card-title">Contact</p>
                                <p>{{$person->contact}}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <p class="card-title">Height</p>
                                <p>{{$person->height}}</p>
                                <p class="card-title">Weight</p>
                                <p>{{$person->weight}}</p>
                                <p class="card-title">Hair Color</p>
                                <p>{{$person->hair}}</p>
                                <p class="card-title">Eye Color</p>
                                <p>{{$person->eye}}</p>
                                <p class="card-title">Ethnicity</p>
                                <p>{{$person->ethnicity}}</p>
                                <p class="card-title">Statement</p>
                                <p>{{$person->statement}}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            @endforeach

        </div>


    </div>
    <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab" tabindex="0">

        <h3 class="mb-3">Progress Logs</h3>

        @foreach ($progresses as $progress)
        <div class="col-sm-9 mb-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$progress->subject}} <span class="float-end">{{$progress->created_at->format('M d, Y H:i:s A')}}</span></h4>
                    <p class="card-text">{{$progress->note}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection