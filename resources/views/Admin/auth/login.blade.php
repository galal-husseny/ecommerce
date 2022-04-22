@extends('layouts.app')
@section('title', 'تسجيل الدخول')
@section('content')
    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url({{ asset('assets/admin/images/bg/1.jpg') }});background-repeat: no-repeat;background-size:cover">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                {{-- <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(images/login-inner-bg.jpg);">
                        <div class="login-fancy">
                            <h2 class="text-white mb-20">Hello world!</h2>
                            <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose
                                responsive template along with powerful features.</p>
                            <ul class="list-unstyled  pos-bot pb-30">
                                <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
                                <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div> --}}
                <div class="col-lg-4 col-md-6 bg-white">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">تسجيل الدخول كمشرف</h3>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="email">البريد الالكتروني* </label>
                                <input id="email" type="email" class="web form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">كلمة المرور* </label>
                                <input id="password" type="password"
                                    class="Password form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <input type="checkbox" class="form-control" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label for="remember"> تذكرني</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="float-right">هل نسيت كلمة
                                            المرور؟</a>
                                    @endif
                                </div>
                            </div>
                            <button class="button">
                                <span>تسجيل الدخول</span>
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
