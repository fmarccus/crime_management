<div class="card">
    <div class="card-header">
        <h5 class="card-title">Change Password</h5>

    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')
            @if (session('status') == 'password-updated')
            <script>
                Swal.fire({
                    icon: 'success',
                    text: 'Password has been updated.',
                })
            </script>
            @endif
            <div class="row mb-3">
                <label for="current_password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>
                <div class="col-md-6">
                    <input id="current_password" type="password" class="form-control @error('current_password','updatePassword') is-invalid @enderror" name="current_password">

                    @error('current_password','updatePassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password','updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password','updatePassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>