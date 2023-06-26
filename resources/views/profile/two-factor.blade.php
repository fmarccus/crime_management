<div class="card">
    <div class="card-header">
        <h5 class="card-title">Two Factor Authentication</h5>
    </div>

    <div class="card-body">
        @if (session('status') == 'two-factor-authentication-disabled')
        <div class="alert alert-success" role="alert">
            <script>
                Swal.fire({
                    icon: 'info',
                    text: 'Two factor authentication has been disabled.',
                })
            </script>
        </div>
        @elseif (session('status') == 'two-factor-authentication-enabled')
        <script>
            Swal.fire({
                icon: 'success',
                text: 'Two factor authentication has been enabled.',
            })
        </script>
        @endif
        <form action="{{route('two-factor.enable')}}" method="post">
            @csrf
            @if(auth()->user()->two_factor_secret)
            @method('delete')
            <p class="card-text">When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
            <div class="my-3">

                <div class="sidebar-cta">
                    <div class="bg-light p-3">
                        <div class="mb-3 text-sm">
                            <p class="card-text"> Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.</p>
                            {!!auth()->user()->twoFactorQrCodeSvg()!!}

                            <ul class="mt-3">
                                @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                <li>{{$code}}</li>
                                @endforeach
                            </ul>
                            <div>
                                <p class="card-text">Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.</p>


                            </div>
                            <button class="btn btn-danger mt-3">Disable</button>

                        </div>



                    </div>
                </div>
            </div>
            @else
            <p class="card-text">Add additional security to your account using two factor authentication.</p>
            <button class="btn btn-primary">Enable</button>
            @endif
        </form>
    </div>
</div>