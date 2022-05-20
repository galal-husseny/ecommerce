@extends('layouts.admin')
@section('title', ' أنشاء تاجر')
@section('breadcrumb')
    {{ Breadcrumbs::render('sellers.create') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('sellers.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">الأسم </label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="national_id">الرقم القومي </label>
                <input type="number" name="national_id" value="{{ old('national_id') }}" class="form-control"
                    id="national_id">
            </div>
            <div class="form-group">
                <label for="phone">رقم الهاتف </label>
                <input type="number" name="phone" value="{{ old('phone') }}" class="form-control"
                    id="phone">
            </div>
            <div class="form-group">
                <label for="email">البريد الالكتروني </label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="password">كلمة مرور </label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">تأكيد كلمة مرور </label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                    class="form-control" id="password_confirmation">
            </div>
            <div class="form-group">
                <label for="gender">النوع</label>
                <select name="gender" class="custom-select" id="gender">
                    <option value="m">Male</option>
                    <option value="f">Female</option>

                </select>
            </div>
            <div class="form-group">
                <label for="status">حالة البريد الالكتروني</label>
                <select name="email_verified_at" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('status') == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">حالة التاجر</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('status') == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">رفع</span>
                </div>
                <div class="custom-file">
                    <input type="file" name='image' class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">الصورة الشخصية </label>
                </div>
            </div>
            <div class="form-group ">
                <label for="socail_links">روابط مواقع التواصل الاجتماعي</label>
                <div class="repeater">
                    <div data-repeater-list="social_links">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="col-lg-10">
                                    <input class="form-control" name="social_link" type="text"
                                        placeholder="https://www.example/account.com" />
                                </div>
                                <div class="col-lg-2">
                                    <input class="btn btn-danger btn-block"  data-repeater-delete type="button"
                                        value="Delete" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-12">
                            <input class="button" data-repeater-create type="button" value="Add new" />
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
