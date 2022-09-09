@extends('layouts.app')
@section('title','تأكيد كلمة المرور')
@section('content')
<section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url({{ asset('assets/admin/images/bg/1.jpg') }});background-repeat: no-repeat;background-size:cover">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-6 col-md-6 bg-white">

                    <form action="{{ route('users.password.confirm')}}" method="post">
                        @csrf
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30">يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة. </h3>
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

                            <button class="button">
                                <span> تأكيد كلمة المرور </span>
                                <i class="fa fa-check"></i>
                            </button>
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        هل نسيت كلمة المرور؟
                                    </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
