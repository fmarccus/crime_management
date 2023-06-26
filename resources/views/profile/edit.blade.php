@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Two Factor Authentication -->
            @include('profile.two-factor')

            <!-- Profile Information -->
            @include('profile.profile')

            <!-- Password -->
            @include('profile.password')

        </div>
    </div>
</div>
@endsection