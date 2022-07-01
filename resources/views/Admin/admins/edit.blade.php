@extends('layouts.admin')
@section('title', " تعديل {$admin->name}")
@section('breadcrumb')
    {{ Breadcrumbs::render('admins.edit', $admin) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('admins.update', ['admin' => $admin->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="text">الأسم </label>
                <input type="text" name="name" value="{{ $admin->name }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="text">البريد الالكتروني </label>
                <input type="email" name="email" value="{{ $admin->email }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="status">حالة البريد الالكتروني</label>
                <select name="email_verified_at" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($admin->email_verified_at && $value == 1) @selected(!$admin->email_verified_at && $value == 0)   value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="text">كلمة مرور </label>
                <input type="password" name="password" value="" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="text">تأكيد كلمة مرور </label>
                <input type="password" name="password_confirmation" value="" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="status">حالة المستخدم </label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($admin->status == $value)   value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role_id">الوظيفة</label>
                <select name="role_id" class="custom-select" id="role_id">
                    @foreach ($roles as $role)
                        <option @selected(in_array($role->name, $admin->getRoleNames()->toArray())) value="{{ $role->id }}"> {{ $role->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="row">
                    <div class="col-3">
                        <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01"
                            onchange="previewImage(event)">
                        <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                                src="{{ $admin->getFirstMediaUrl('admins')? asset($admin->getFirstMediaUrl('admins')): asset('assets/admin/images/default.png') }}"
                                class="w-100" alt="{{ $admin->name }}" style="cursor: pointer"> </label>

                    </div>
                </div>
            </div>
            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        var previewImage = function(event) {
            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endpush
