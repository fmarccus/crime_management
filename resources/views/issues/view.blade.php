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
@elseif(session()->has('person'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'A new person of interest has been added',
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
        @if(auth()->user()->user_type !=3)
        <h3 class="mb-3">Add Witnesses and Suspects</h3>
        <div class="row">
            <div class="col-sm-9">
                <form action="{{route('person.store', $issue->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">Suspects and Witnesses
                            </h4>
                            <div class="text-end">
                                <button class="btn btn-primary" type="button" id="add-row-btn"><i class="align-middle" data-feather="user-plus"></i></button>
                            </div>
                            <div id="input-container">
                                <div class="row">

                                    <div class="col-sm-9 mb-2">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="person_data[0][person_name]" />
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <label for="" class="form-label">Status</label>
                                        <select class="form-select" name="person_data[0][person_type]">
                                            <option value="witness">Witness</option>
                                            <option value="suspect">Suspect</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Gender</label>
                                        <select class="form-select" name="person_data[0][gender]">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Date of Birth</label>
                                        <input class="form-control" type="date" name="person_data[0][dob]" id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input class="form-control" type="text" name="person_data[0][address]" id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Contact Information</label>
                                        <input class="form-control" type="text" name="person_data[0][contact]" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Height</label>
                                        <input class="form-control" min="1" type="number" name="person_data[0][height]" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Weight</label>
                                        <input class="form-control" min="1" type="number" name="person_data[0][weight]" id="">
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Hair Color</label>
                                        <input type="text" class="form-control" name="person_data[0][hair]" />
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="" class="form-label">Eye Color</label>
                                        <input type="text" class="form-control" name="person_data[0][eye]" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Ethnicity</label>
                                        <input type="text" class="form-control" name="person_data[0][ethnicity]" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Photograph/Identification</label>
                                        <input type="file" class="form-control" name="person_data[0][identification]" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Statement</label>
                                        <textarea class="form-control" name="person_data[0][statement]" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <hr>
                            </div>



                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit"> Submit</button>
                </form>
            </div>
        </div>
        @endif




    </div>
    <div class="tab-pane fade" id="pills-progress" role="tabpanel" aria-labelledby="pills-progress-tab" tabindex="0">
        @if (auth()->user()->user_type != 3)
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
        @endif

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

    <div class="tab-pane fade" id="pills-evidences" role="tabpanel" aria-labelledby="pills-evidences-tab" tabindex="0">

        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('store.evidence', $issue->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="" class="form-label">Attach Your Evidences Here</label>
                            <input type="file" class="form-control" name="imageFile[]" id="images" aria-describedby="helpId" multiple>
                            <div class="evidence-image mb-3 text-center">
                                <div class="imgPreview"> </div>
                            </div>

                            <button class="btn btn-primary" type="submit"> Add Evidence</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if(!empty($evidences))
            @foreach ($evidences as $evidence)

            <div class="col-sm-4 mb-3">
                <img data-enlargable class="img-fluid" src="{{asset('evidences/'.$evidence)}}">

            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>


</div>

@endsection
@section('scripts')
<script>
    let rowCount = 1; // To keep track of the current row count

    // Function to add a new row when the button is clicked
    $("#add-row-btn").click(function() {
        var newRow = $("<div>");
        newRow.html(`
    <div class="row"> 
        <div class="col-sm-9 mb-3"> 
        <label for="" class="form-label">Name</label>

            <input type="text" class="form-control" name="person_data[${rowCount}][person_name]" />
        </div>
        <div class="col-sm-3 mb-3">
        <label for="" class="form-label">Status</label>

            <select class="form-select" name="person_data[${rowCount}][person_type]">
                <option value="witness">Witness</option>
                <option value="suspect">Suspect</option>
            </select>
        </div>
        <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Gender</label>
                        <select class="form-select" name="person_data[${rowCount}][gender]">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Date of Birth</label>
                        <input class="form-control" type="date" name="person_data[${rowCount}][dob]" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                        <input class="form-control" type="text" name="person_data[${rowCount}][address]" id="">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Contact Information</label>
                        <input class="form-control" type="text" name="person_data[${rowCount}][contact]" id="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Height</label>
                        <input class="form-control" min="1" type="number" name="person_data[${rowCount}][height]" id="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Weight</label>
                        <input class="form-control" min="1" type="number" name="person_data[${rowCount}][weight]" id="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Hair Color</label>
                        <input type="text" class="form-control" name="person_data[${rowCount}][hair]" />
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label">Eye Color</label>
                        <input type="text" class="form-control" name="person_data[${rowCount}][eye]" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ethnicity</label>
                        <input type="text" class="form-control" name="person_data[${rowCount}][ethnicity]" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photograph/Identification</label>
                        <input type="file" class="form-control" name="person_data[${rowCount}][identification]" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Statement</label>
                        <textarea class="form-control" name="person_data[${rowCount}][statement]" id="" cols="30" rows="10"></textarea>
                    </div>
    </div>
    <hr>
`);

        $("#input-container").append(newRow);
        rowCount++; // Increment the row count for the next row
    });
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img class="img-fluid me-2 mb-2 mt-2" height="480" width="360">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#images').on('change', function() {
        multiImgPreview(this, 'div.imgPreview');
    });
    $('img[data-enlargable]').addClass('img-enlargable').click(function() {
        var src = $(this).attr('src');
        $('<div>').css({
            background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
            backgroundSize: 'contain',
            width: '100%',
            height: '100%',
            position: 'fixed',
            zIndex: '10000',
            top: '0',
            left: '0',
            cursor: 'zoom-out'
        }).click(function() {
            $(this).remove();
        }).appendTo('body');
    });
</script>
@endsection