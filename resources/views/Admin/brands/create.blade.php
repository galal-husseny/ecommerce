@extends('layouts.admin')
@section('title', ' أنشاء علامة تجارية')
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> أنشاء علامة تجارية </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('brands.store') }}">
            @csrf
            <div class="form-group">
                <label for="text">ألاسم</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="text" placeholder="أكتب أسم العلامة التجارية">
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    <option disabled selected>أختار</option>
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
                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">أختار لوجو العلامة التجارية</label>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
