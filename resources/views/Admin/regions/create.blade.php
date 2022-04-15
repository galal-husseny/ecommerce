@extends('layouts.admin')
@section('title', ' أنشاء المناطق')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endpush
@section('breadcrumb')
    {{Breadcrumbs::render('regions.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('regions.store') }}" >
            @csrf
            <div class="form-group">
                <label for="text">أسم المنطقة باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{ old('name.en') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="textar">أسم المنطقة باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{ old('name.ar') }}" class="form-control" id="textar">
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="latitude" class="d-block"> خط عرض نقطة المنتصف</label>
                    <input type="number" step="0.0001" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}">
                </div>
                <div class="form-group col-4">
                    <label for="longitude" class="d-block"> خط طول نقطة المنتصف</label>
                    <input type="number" step="0.0001" name="longitude" id="longitude" class="form-control" value="{{ old('logitude') }}">
                </div>
                <div class="form-group col-4">
                    <label for="radius" class="d-block">أبعد مسافة عن نقطة المنتصف</label>
                    <input type="number" step="0.0001" name="radius" id="radius" class="form-control" value="{{ old('radius') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="city_id"> المدينة </label>
                <select name="city_id" class="custom-select" id="city_id">
                    <option disabled selected>أختر</option>
                    @foreach ($cities as $city)
                        <option @selected(old('city_id') == $city->id) value="{{ $city->id }}">
                            {{ $city->getTranslation('name', 'en') }} - {{ $city->getTranslation('name', 'ar') }}
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
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection

