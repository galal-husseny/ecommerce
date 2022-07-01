@extends('layouts.admin')
@section('title', ' أنشاء مُشرف')
@section('breadcrumb')
    {{Breadcrumbs::render('admins.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">الأسم </label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">البريد الالكتروني </label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="status">حالة البريد الالكتروني</label>
                <select name="email_verified_at" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('email_verified_at') == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="text">كلمة مرور </label>
                <input type="password" name="password" value="{{old('password')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">تأكيد كلمة مرور </label>
                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="status">حالة المشرف</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('status') == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role_id">الوظيفة</label>
                <select name="role_id" class="custom-select" id="role_id">
                    @foreach ($roles as $role)
                        <option @selected(old('role_id') == $role->id) value="{{ $role->id }}"> {{ $role->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">رفع</span>
                </div>
                <div class="custom-file">
                    <input type="file" name='image' class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">الصورة الشخصية  </label>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
<script>
    $('#all').change(function(){
        if(this.checked){
            $('.check-box').attr('checked','checked');
        }else{
            $('.check-box').removeAttr('checked');
        }
    });
</script>
@endpush


