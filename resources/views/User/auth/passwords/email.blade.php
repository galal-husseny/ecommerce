@extends('layouts.app')
@section('title','استرجاع كلمة المرور')
@section('content')
    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url({{ asset('assets/admin/images/bg/1.jpg') }});background-repeat: no-repeat;background-size:cover">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">
                <div class="col-lg-4 col-md-6 bg-white">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('users.password.email')}}" method="post">
                        @csrf
                        <div class="login-fancy pb-40 clearfix">
                            <h3 class="mb-30"> التأكد من البريد الالكتروني </h3>
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

                            <button class="button">
                                <span> إرسال رابط إعادة تعيين كلمة السر </span>
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
