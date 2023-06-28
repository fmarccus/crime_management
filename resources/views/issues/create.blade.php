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
        <div class="card">
            <div class="card-body">
                <a href="{{route('issues.index')}}" class="btn btn-light mb-3">Back</a>

                <form action="{{route('issues.store')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Police Officer</label>
                        <input class="form-select @error('user_id') is-invalid @enderror"  list="officers" name="user_id" id="user_id">
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
                        <label for="complainant" class="form-label">Complainant</label>
                        <input type="text" class="form-control @error('complainant') is-invalid @enderror" name="complainant" id="complainant" aria-describedby="helpId" placeholder="" value="{{old('complainant')}}">
                        @error('complainant')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" aria-describedby="helpId" placeholder="" value="{{old('phone')}}">
                        @error('phone')
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
                        <label for="severity" class="form-label">Severity</label>
                        <select class="form-select @error('severity') is-invalid @enderror" name="severity" id="severity">
                            <option value="Normal">Normal</option>
                            <option value="Severe">Severe</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection