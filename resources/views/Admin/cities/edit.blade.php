@extends('layouts.admin')
@section('title', "تعديل {$city->name}")
@section('breadcrumb')
    {{Breadcrumbs::render('cities.edit',$city)}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('cities.update',['city'=>$city->id]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">أسم  المدينة باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{$city->getTranslation('name', 'en')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">أسم المدينة باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{$city->getTranslation('name', 'ar')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($city->status == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
        </form>
    </div>
@endsection
