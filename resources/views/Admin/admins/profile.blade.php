@extends('layouts.admin')
@section('title', 'الصفحة الشخصية')
@section('content')
    @include('includes.validation-errors')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    <div class="col-12 mt-5">
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-2 offset-5">
                    <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01"
                        onchange="previewImage(event)">
                    <label for="inputGroupFile01">
                        <img for="inputGroupFile01" id="image"
                            src="{{ $admin->getFirstMediaUrl('admins') ? asset($admin->getFirstMediaUrl('admins')) : asset('assets/admin/images/default.png') }}"
                            class="w-100 rounded-circle" alt="{{ $admin->name }}" style="cursor: pointer">
                    </label>
                </div>
                <div class="col-4 offset-4">
                    <div class="form-group">
                        <label for="Name">الأسم</label>
                        <input type="text" name="name" id="Name" class="form-control" placeholder=""  aria-describedby="helpId" value="{{ $admin->name }}">
                    </div>
                    <div class="form-group">
                        <a class="text-primary" href="{{ route('profile.reset.password') }}" class="float-right">هل تريد تعديل كلمة
                            المرور؟</a>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-success rounded"> تعديل </button>
                    </div>
                </div>
            </div>
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
