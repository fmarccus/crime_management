@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'Issue has been added',
    })
</script>
@endif
<div class="row">
    <h3 class="mb-3">Add A New Issue</h3>
    <div class="col-sm-9">
        <form action="{{route('issues.store')}}" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>
                    <p class="card-title">Assigned Officers</p>



                    <div class="mb-3">
                        <label for="user_id" class="form-label">Police Officer</label>
                        <input class="form-select @error('user_id') is-invalid @enderror" list="officers" name="user_id" id="user_id">
                        <datalist id="officers">
                            @foreach ($officers as $officer)
                            <option value="{{$officer->id}}">{{$officer->name}} {{$officer->surname}}</option>
                            @endforeach
                        </datalist>
                        @error('user_id')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="investigator_id" class="form-label">Investigator</label>
                        <input class="form-select @error('investigator_id') is-invalid @enderror" list="investigators" name="investigator_id" id="investigator_id">
                        <datalist id="investigators">
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
                    <p class="card-title">Incident Report</p>
                    <div class="mb-3">
                        <label for="complainant" class="form-label">Complainant</label>
                        <input class="form-select @error('complainant_id') is-invalid @enderror" list="complainants" name="complainant_id" id="complainant_id">
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
                        <textarea class="form-control @error('issue') is-invalid @enderror" name="issue" id="issue" rows="8"></textarea>
                        @error('issue')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date of Incident</label>
                        <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" id="date">
                        @error('date')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Area of Incident</label>
                        <select class="form-select @error('area') is-invalid @enderror" name="area" id="area">
                            <option>Aguho</option>
                            <option>Magtanggol</option>
                            <option>Martires del 96</option>
                            <option>Poblacion</option>
                            <option>San Pedro</option>
                            <option>San Roque</option>
                            <option>Santa Ana</option>
                            <option>Santo Rosario Kanluran</option>
                            <option>Santo Rosario Silangan</option>
                            <option>Tabacalera</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type of Issue</label>
                        <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
                            <option>Assault</option>
                            <option>Burglary</option>
                            <option>Robbery</option>
                            <option>Theft</option>
                            <option>Fraud</option>
                            <option>Vandalism</option>
                            <option>Kidnapping</option>
                            <option>Homicide</option>
                            <option>Drug-related offenses</option>
                            <option>Cybercrime</option>
                            <option>Harassment</option>
                            <option>Domestic violence</option>
                            <option>Sexual assault</option>
                            <option>Arson</option>
                            <option>Carjacking</option>
                            <option>Human trafficking</option>
                            <option>Hate crime</option>
                            <option>Money laundering</option>
                            <option>Identity theft</option>
                            <option>Embezzlement</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="severity" class="form-label">Severity</label>
                        <select class="form-select @error('severity') is-invalid @enderror" name="severity" id="severity">
                            <option value="Normal">Normal</option>
                            <option value="Severe">Severe</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection