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
        <form action="{{route('issues.update',$issue->id)}}" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>


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
            <div class="card">
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
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection