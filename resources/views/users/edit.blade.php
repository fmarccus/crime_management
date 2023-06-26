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
    <h3 class="mb-3">Edit </h3>
    <div class="col-sm-9">
        <div class="card">
            <div class="card-body">
                <a href="{{route('users.index')}}" class="btn btn-light mb-3">Back</a>

                <form action="{{route('users.update',$user->id)}}" method="post">
                    @csrf
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
                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection