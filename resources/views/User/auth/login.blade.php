@extends('layouts.app')
@section('title', 'تسجيل الدخول')
{{-- @push('css')
    {!! htmlScriptTagJsApi() !!}
@endpush --}}
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
                <div class="col-lg-5 col-md-6 bg-white">
                    <form action="{{ route('users.login') }}" method="post">
                        @csrf
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">تسجيل الدخول كمشرف</h3>
                            @error('g-recaptcha-response')
                                <div class="alert alert-danger text-center">حدث خطأ في محاولة التسجيل</div>
                            @enderror
                            <div class="section-field mb-20">
                                <label class="mb-10" for="email">البريد الالكتروني* </label>
                                <input id="email" type="email"
                                    class="web form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
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
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            {{-- <div class="section-field mb-20">
                                {!! htmlFormSnippet() !!}
                            </div> --}}


                            <div class="section-field">

                                <div class="remember-checkbox mb-30">
                                    <input type="checkbox" class="form-control" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label for="remember"> تذكرني</label>
                                    @if (Route::has('users.password.request'))
                                        <a href="{{ route('users.password.request') }}" class="float-right">هل نسيت كلمة
                                            المرور؟</a>
                                    @endif
                                </div>
                            </div>
                            <button class="button">
                                <span>تسجيل الدخول</span>
                                <i class="fa fa-check"></i>
                            </button>

                            <p class="text-center my-4"> OR </p>
                            <a href="{{route('users.google.login')}}" class="btn bg-danger my-2 text-light form-control">
                                Login With Google
                            </a>
                            <a href="{{route('users.facebook.login')}}" class="btn bg-primary my-2 text-light form-control">
                                Login With Facebook
                            </a>
                            <a href="{{route('users.github.login')}}" class="btn bg-dark my-2 text-light form-control">
                                Login With Github
                            </a>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
