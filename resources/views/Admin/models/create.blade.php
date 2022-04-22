@extends('layouts.admin')
@section('title', ' أنشاء الموديلات')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    {{Breadcrumbs::render('models.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('models.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">أسم الموديل باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{ old('name.en') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="textar">أسم الموديل باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{ old('name.ar') }}" class="form-control" id="textar">
            </div>
            <div class="form-group">
                <label for="datepicker" class="d-block"> تاريخ الموديل </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" id="datepicker" class="form-control" name="year" value="{{ old('year') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="brand_id"> العلامة التجارية </label>
                <select name="brand_id" class="custom-select" id="brand_id">
                    <option disabled selected>أختر</option>
                    @foreach ($brands as $brand)
                        <option @selected(old('brand_id') == $brand->id) value="{{ $brand->id }}">
                            {{ $brand->getTranslation('name', 'en') }} - {{ $brand->getTranslation('name', 'ar') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('status') === $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">رفع</span>
                </div>
                <div class="custom-file">
                    <input type="file" name='image' class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">أختار لوجو الموديل</label>
                </div>
            </div>
            <div class="form-group">
                <input  name='resize' type="checkbox" id="resize" value="exist">
                <label for="resize">تغير أبعاد الصورة</label>
                <div id="resizebox" class="row d-none">
                    <div class="col-2">
                        <input type="number" name="width" value="{{ old('width') }}" class="form-control" id="text"
                            placeholder="العرض">
                    </div>
                    <div class="col-2">
                        <input type="number" name="height" value="{{ old('height') }}" class="form-control" id="text"
                            placeholder="الطول">
                    </div>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script>
        $('#resize').on('change', function() {
            $('#resizebox').toggleClass('d-none');
        });
    </script>
@endpush
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
@endpush
