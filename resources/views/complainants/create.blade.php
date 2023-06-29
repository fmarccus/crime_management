@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'Complainant has been added',
    })
</script>
@endif
<div class="row">
    <h3 class="mb-3">Add A New Complainant</h3>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <a href="{{route('complainants.index')}}" class="btn btn-light mb-3">Back</a>

                <form action="{{route('complainants.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{old('name')}}">
                                @error('name')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middle Name</label>
                                <input type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" id="middlename" aria-describedby="helpId" placeholder="" value="{{old('middlename')}}">
                                @error('middlename')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname" aria-describedby="helpId" placeholder="" value="{{old('surname')}}">
                                @error('surname')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" step="1" min="1" max="120" class="form-control @error('age') is-invalid @enderror" name="age" id="age" aria-describedby="helpId" placeholder="" value="{{old('age')}}">
                                @error('age')
                                <div>
                                    <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
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
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{old('email')}}">
                        @error('email')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{old('address')}}">
                        @error('address')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection