@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'A new user has been added',
    })
</script>
@endif
<div class="row">
    <h3 class="mb-3">Add A New User</h3>
    <div class="col-sm-9">
        <form action="{{route('users.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('users.index')}}" class="btn btn-light mb-3">Back</a>


                    <p class="card-title">Personal Information</p>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{old('name')}}">
                        @error('name')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname" aria-describedby="helpId" placeholder="" value="{{old('surname')}}">
                        @error('surname')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" min="1" max="99" class="form-control @error('age') is-invalid @enderror" name="age" id="age" aria-describedby="helpId" placeholder="" value="{{old('age')}}">
                        @error('age')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
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
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{old('address')}}">
                        @error('address')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-title">Account Credentials</p>
                    <div class="mb-3">
                        <label for="user_type" class="form-label">User Type</label>
                        <select class="form-select @error('user_type') is-invalid @enderror" name="user_type" id="user_type">
                            <option value="2">Investigator</option>
                            <option value="1">Police Officer/System User</option>
                            <option value="0">Admin/Master</option>
                            <option value="3">Complainant</option>
                        </select>
                        @error('user_type')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rank" class="form-label">Police Rank</label>
                        <select class="form-select @error('rank') is-invalid @enderror" name="rank" id="rank">
                            <option>n/a</option>
                            <option>Police General</option>
                            <option>Police Lieutenant General</option>
                            <option>Police Major General</option>
                            <option>Police Brigadier General</option>
                            <option>Police Colonel</option>
                            <option>Police Lieutenant Colonel</option>
                            <option>Police Major</option>
                            <option>Police Captain</option>
                            <option>Police Lieutenant</option>
                            <option>Police Executive Master Sergeant</option>
                            <option>Police Chief Master Sergeant</option>
                            <option>Police Senior Master Sergeant</option>
                            <option>Police Master Sergeant</option>
                            <option>Police Staff Sergeant</option>
                            <option>Police Corporal</option>
                            <option>Patrolman/Patrolwoman</option>
                        </select>
                        @error('rank')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{old('email')}}">
                        @error('email')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" aria-describedby="helpId" placeholder="">
                        @error('password')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Please confirm the password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="">
                        @error('password_confirmation')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection