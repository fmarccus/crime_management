@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'Issue has been updated',
    })
</script>
@elseif(session()->has('progress'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'Progress has been logged',
    })
</script>
@endif
<div class="row">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="{{route('issues.index')}}" class="btn btn-light me-1">Back</a>

        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Incident Report</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Progress Tracking <span class="badge rounded-pill text-bg-warning">{{$progresses->count()}}</span></button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <h3 class="mb-3">Edit this Incident</h3>
            <div class="col-sm-9">
                <form action="{{route('issues.update',$issue->id)}}" method="post">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-body">

                            <p class="card-title">Dispatched Personnels</p>

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

                                <label for="investigator_id" class="form-label">Investigator Assigned: <a href="{{route('users.edit', $issue->investigator->id)}}">({{$issue->getFullNameInvestigator()}})</a></label>
                                <input class="form-select @error('investigator_id') is-invalid @enderror" list="investigators" name="investigator_id" id="investigator_id" value="{{$issue->investigator_id}}">
                                <datalist id="investigators">
                                    <option value="">Remove The Assigned Investigator</option>
                                    @foreach ($investigators as $investigator)
                                    <option value="{{$investigator->id}}">{{$investigator->name}} {{$investigator->surname}}</option>
                                    @endforeach
                                </datalist>
                                @error('investigator_id')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>


                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Incident Report</h4>
                            <div class="mb-3">
                                <label for="complainant" class="form-label">Complainant <a href="{{route('users.edit', $issue->complainant->id)}}">({{$issue->getFullNameComplainant()}}, {{$issue->complainant->gender}}, {{$issue->complainant->age}})</a></label>

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
                                <label for="date" class="form-label">Date of Incident</label>
                                <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{$issue->date}}">
                                @error('date')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="area" class="form-label">Area of Incident</label>
                                <select class="form-select @error('area') is-invalid @enderror" name="area" id="area">
                                    <option @if($issue->area == "Aguho") selected @endif>Aguho</option>
                                    <option @if($issue->area == "Magtanggol") selected @endif>Magtanggol</option>
                                    <option @if($issue->area == "Martires del 96") selected @endif>Martires del 96</option>
                                    <option @if($issue->area == "Poblacion") selected @endif>Poblacion</option>
                                    <option @if($issue->area == "San Pedro") selected @endif>San Pedro</option>
                                    <option @if($issue->area == "San Roque") selected @endif>San Roque</option>
                                    <option @if($issue->area == "Santa Ana") selected @endif>Santa Ana</option>
                                    <option @if($issue->area == "Santo Rosario Kanluran") selected @endif>Santo Rosario Kanluran</option>
                                    <option @if($issue->area == "Santo Rosario Silangan") selected @endif>Santo Rosario Silangan</option>
                                    <option @if($issue->area == "Tabacalera") selected @endif>Tabacalera</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type of Issue</label>
                                <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                                    <option @if($issue->type == "Assault") selected @endif >Assault</option>
                                    <option @if($issue->type == "Burglary") selected @endif >Burglary</option>
                                    <option @if($issue->type == "Robbery") selected @endif >Robbery</option>
                                    <option @if($issue->type == "Theft") selected @endif >Theft</option>
                                    <option @if($issue->type == "Fraud") selected @endif >Fraud</option>
                                    <option @if($issue->type == "Vandalism") selected @endif >Vandalism</option>
                                    <option @if($issue->type == "Kidnapping") selected @endif >Kidnapping</option>
                                    <option @if($issue->type == "Homicide") selected @endif >Homicide</option>
                                    <option @if($issue->type == "Drug-related offenses") selected @endif >Drug-related offenses</option>
                                    <option @if($issue->type == "Cybercrime") selected @endif >Cybercrime</option>
                                    <option @if($issue->type == "Harassment") selected @endif >Harassment</option>
                                    <option @if($issue->type == "Domestic violence") selected @endif >Domestic violence</option>
                                    <option @if($issue->type == "Sexual assault") selected @endif >Sexual assault</option>
                                    <option @if($issue->type == "Arson") selected @endif >Arson</option>
                                    <option @if($issue->type == "Carjacking") selected @endif >Carjacking</option>
                                    <option @if($issue->type == "Human trafficking") selected @endif >Human trafficking</option>
                                    <option @if($issue->type == "Hate crime") selected @endif >Hate crime</option>
                                    <option @if($issue->type == "Money laundering") selected @endif >Money laundering</option>
                                    <option @if($issue->type == "Identity theft") selected @endif >Identity theft</option>
                                    <option @if($issue->type == "Embezzlement") selected @endif >Embezzlement</option>
                                </select>
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
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Suspects and Witnesses
                            </h4>
                            <div id="input-container">
                                @php
                                $index = 1;
                                @endphp
                                @foreach($issue->persons as $person)
                                <h4 class="fw-bold">Person {{$index}}</h4>
                                <div class="row">
                                    <input type="hidden" name="person_data[{{$index}}][personId]" value="{{$person->id}}">
                                    <div class="col-sm-9 mb-2">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="person_data[{{$index}}][person_name]" value="{{$person->person_name}}" />
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="" class="form-label">Status</label>
                                        <select class="form-select" name="person_data[{{$index}}][person_type]">
                                            <option @if($person->person_type == 'witness') selected @endif" value="witness">Witness</option>
                                            <option @if($person->person_type == 'suspect') selected @endif" value="suspect">Suspect</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-select" name="person_data[{{$index}}][gender]">
                                            <option @if($person->gender == 'Male') selected @endif value="Male">Male</option>
                                            <option @if($person->gender == 'Female') selected @endif value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Date of Birth</label>
                                        <input class="form-control" type="date" name="person_data[{{$index}}][dob]" id="" value="{{$person->dob}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input class="form-control" type="text" name="person_data[{{$index}}][address]" value="{{$person->address}}" id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Contact Information</label>
                                        <input class="form-control" type="text" name="person_data[{{$index}}][contact]" value="{{$person->contact}}" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Height</label>
                                        <input class="form-control" min="1" type="number" name="person_data[{{$index}}][height]" value="{{$person->height}}" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Weight</label>
                                        <input class="form-control" min="1" type="number" name="person_data[{{$index}}][weight]" value="{{$person->weight}}" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Hair Color</label>
                                        <input type="text" class="form-control" name="person_data[{{$index}}][hair]" value="{{$person->hair}}" />
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Eye Color</label>
                                        <input type="text" class="form-control" name="person_data[{{$index}}][eye]" value="{{$person->eye}}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ethnicity</label>
                                        <input type="text" class="form-control" name="person_data[{{$index}}][ethnicity]" value="{{$person->ethnicity}}" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Photograph/Identification</label>
                                        <input type="file" class="form-control" name="person_data[{{$index}}][identification]" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Statement</label>
                                        <textarea class="form-control" name="person_data[{{$index}}][statement]" id="" cols="30" rows="10">{{$person->statement}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                @php
                                $index++;
                                @endphp


                                @endforeach
                            </div>


                        </div>
                    </div>
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <div class="col-sm-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('progress.store', $issue->id)}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="" aria-describedby="helpId" placeholder="">
                                @error('subject')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="" rows="10" placeholder="You may add your note here"></textarea>
                                @error('note')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 class="mb-3">Progress Logs</h3>

                @foreach ($progresses as $progress)
                <div class="mb-3">
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

    </div>


</div>
@endsection