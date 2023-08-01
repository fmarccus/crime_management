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
    <h3 class="mb-3">Add A New Incident</h3>
    <div class="col-sm-9">
        <form action="{{route('issues.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if (auth()->user()->user_type==3)
            <a href="{{route('issues.index')}}" class="btn btn-secondary mb-3">Back</a>

            @else
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>
                    <p class="card-title">Dispatched Personnels</p>
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
            @endif

            <div class="card mb-3">

                <div class="card-body">
                    <p class="card-title">Incident Report</p>
                    @if (auth()->user()->user_type==0)

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
                    @endif
                    <div class="mb-3">
                        <label for="issue" class="form-label">Issue</label>
                        <textarea name="issue" id="issue" rows="8"></textarea>
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

            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">Evidences</h4>
                    <div class="mb-3">
                        <label for="" class="form-label">Attach Images</label>
                        <input type="file" class="form-control" name="imageFile[]" id="images" aria-describedby="helpId" multiple>
                        <div class="evidence-image mb-3 text-center">
                            <div class="imgPreview"> </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Attach Video Recordings</label>
                        <input type="file" class="form-control" name="" id="" aria-describedby="helpId" multiple>
                    </div>
                </div>
            </div>

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

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
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

        tinymce.init({
            selector: '#issue',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
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
    });
</script>
@endsection