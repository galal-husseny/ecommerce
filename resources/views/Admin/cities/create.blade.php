@extends('layouts.admin')
@section('title', ' أنشاء المدن')
@section('breadcrumb')
    {{Breadcrumbs::render('cities.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('cities.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">أسم المدينة باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{old('name.en')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">أسم المدينة باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{old('name.ar')}}" class="form-control" id="text" >
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



