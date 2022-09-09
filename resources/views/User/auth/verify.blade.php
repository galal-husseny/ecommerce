@extends('layouts.app')
@section('title','التحقق من البريد الالكتروني')
@section('content')
    <section class="height-100vh d-flex align-items-center page-section-ptb login"
        style="background-image: url({{ asset('assets/admin/images/bg/1.jpg') }});background-repeat: no-repeat;background-size:cover">
        <div class="container">
            <div class="row justify-content-center no-gutters vertical-align">

                <div class="col-lg-8 col-md-8 m-5 bg-white">

                    <div class="card text-left rounded">
                        <div class="card-header">
                            <h4>تنبيه !</h4>
                        </div>
                      <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.
                            </div>
                    @endif
                        <p>قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق.
                            إذا لم تستلم البريد الإلكتروني</p>
                        <form class="d-inline" method="POST" action="{{ route('users.verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('انقر هنا لطلب بريد آخر') }}</button>.
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
