@extends('layouts.admin')
@section('title', "تعديل {$model->name}")
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    {{Breadcrumbs::render('models.edit',$model)}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('models.update', ['model' => $model->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">أسم الموديل باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{ $model->getTranslation('name', 'en') }}" class="form-control"
                    id="text">
            </div>
            <div class="form-group">
                <label for="text">أسم الموديل باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{ $model->getTranslation('name', 'ar') }}" class="form-control"
                    id="text">
            </div>
            <div class="form-group">
                <label for="datepicker" class="d-block"> تاريخ الموديل </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" id="datepicker" class="form-control" name="year" value="{{ $model->year }}">
                </div>
            </div>
            <div class="form-group">
                <label for="brand_id"> العلامة التجارية </label>
                <select name="brand_id" class="custom-select" id="brand_id">
                    <option disabled selected>أختر</option>
                    @foreach ($brands as $brand)
                        <option @selected($model->brand_id == $brand->id) value="{{ $brand->id }}">
                            {{ $brand->getTranslation('name', 'en') }} - {{ $brand->getTranslation('name', 'ar') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($model->status == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-3">
                    <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01"
                        onchange="previewImage(event)">
                    <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                            src="{{ asset($model->getFirstMediaUrl('models')) }}" class="w-100"
                            alt="{{ $model->name }}" style="cursor: pointer"> </label>
                </div>
            </div>
            <div class="form-group">
                <input @checked(old('resize') === 'true') name='resize' type="checkbox" id="resize" value="true">
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
