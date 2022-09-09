@extends('layouts.app')
@section('title', 'تغير كلمة المرور')
@section('content')

    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url({{ asset('assets/admin/images/bg/1.jpg') }});background-repeat: no-repeat;background-size:cover">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">

                <div class="col-lg-4 col-md-6 bg-white">
                    <form action="{{ route('users.password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30"> تغير كلمة المرور</h3>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="email">البريد الالكتروني* </label>
                                <input id="email" type="email" class="web form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">كلمة المرور الجديدة* </label>
                                <input id="password" type="password"
                                    class="Password form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="section-field mb-20">
                                <label class="mb-10" for="password_confirmation">تأكيد كلمة المرور الجديدة* </label>
                                <input id="password_confirmation" type="password"
                                    class="Password form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                    required autocomplete="password_confirmation">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="button">
                                <span> إستعادة كلمة المرور </span>
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
