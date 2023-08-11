@extends('layouts.app')

@section('content')
@if(session()->has('success'))
<script>
    Swal.fire({
        icon: 'success',
        text: 'User has been updated',
    })
</script>
@endif
<div class="row">
    @if($user->user_type == 0)
    <h3 class="mb-3">Edit {{$user->name}} (USR-{{$user->id}}) </h3>
    @elseif($user->user_type == 1)
    <h3 class="mb-3">Edit {{$user->name}} (POL-{{$user->id}}) </h3>
    @elseif($user->user_type == 2)
    <h3 class="mb-3">Edit {{$user->name}} (INV-{{$user->id}}) </h3>
    @elseif($user->user_type == 3)
    <h3 class="mb-3">Edit {{$user->name}} (COM-{{$user->id}}) </h3>
    @endif


    <div class="col-sm-9">
        <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{route('users.index')}}" class="btn btn-light mb-3">Back</a>
                    <p class="card-title">Personal Information</p>
                    <div class="mb-3">
                        <img class="img-fluid rounded" width="100" height="100" src="{{asset('images/'.$user->photo)}}" alt="No photo uploaded">
                    </div>
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" aria-describedby="helpId" placeholder="" value="{{$user->name}}">
                        @error('name')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname" aria-describedby="helpId" placeholder="" value="{{$user->surname}}">
                        @error('surname')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="M" @if($user->gender == 'M') selected @endif>Male</option>
                            <option value="F" @if($user->gender == 'F') selected @endif>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" aria-describedby="helpId" placeholder="" value="{{$user->phone}}">
                        @error('phone')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" aria-describedby="helpId" placeholder="" value="{{$user->address}}">
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
                            <option @if($user->user_type == 2) selected @endif value="2">Investigator</option>
                            <option @if($user->user_type == 1) selected @endif value="1">Police Officer/System User</option>
                            <option @if($user->user_type == 3) selected @endif value="3">Complainant</option>

                            <option @if($user->user_type == 0) selected @endif value="0">Admin/Master</option>

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
                            <option @if($user->rank == "n/a") selected @endif>n/a</option>
                            <option @if($user->rank == "Police General") selected @endif>Police General</option>
                            <option @if($user->rank == "Police Lieutenant General") selected @endif>Police Lieutenant General</option>
                            <option @if($user->rank == "Police Major General") selected @endif>Police Major General</option>
                            <option @if($user->rank == "Police Brigadier General") selected @endif>Police Brigadier General</option>
                            <option @if($user->rank == "Police Colonel") selected @endif>Police Colonel</option>
                            <option @if($user->rank == "Police Lieutenant Colonel") selected @endif>Police Lieutenant Colonel</option>
                            <option @if($user->rank == "Police Major") selected @endif>Police Major</option>
                            <option @if($user->rank == "Police Captain") selected @endif>Police Captain</option>
                            <option @if($user->rank == "Police Lieutenant") selected @endif>Police Lieutenant</option>
                            <option @if($user->rank == "Police Executive Master Sergeant") selected @endif>Police Executive Master Sergeant</option>
                            <option @if($user->rank == "Police Chief Master Sergeant") selected @endif>Police Chief Master Sergeant</option>
                            <option @if($user->rank == "Police Senior Master Sergeant") selected @endif>Police Senior Master Sergeant</option>
                            <option @if($user->rank == "Police Master Sergeant") selected @endif>Police Master Sergeant</option>
                            <option @if($user->rank == "Police Staff Sergeant") selected @endif>Police Staff Sergeant</option>
                            <option @if($user->rank == "Police Corporal") selected @endif>Police Corporal</option>
                            <option @if($user->rank == "Patrolman/Patrolwoman") selected @endif>Patrolman/Patrolwoman</option>
                        </select>
                        @error('rank')
                        <div>
                            <p class="text-danger bg-light mt-3 py-1">{{$message}}</p>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId" placeholder="" value="{{$user->email}}">
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