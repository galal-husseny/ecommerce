@extends('layouts.admin')
@section('title', 'تعديل كلمة المرور')
@section('content')
    @include('includes.validation-errors')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    <div class="col-12 mt-5">
        <form action="{{ route('profile.update.password') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4 offset-4">
                    <div class="form-group">
                        <label for="old_password">كلمة المرور القديمة</label>
                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder=""  aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور الجديدة</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder=""  aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">تأكيد المرور الجديدة</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder=""  aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-outline-success rounded"> تعديل </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
