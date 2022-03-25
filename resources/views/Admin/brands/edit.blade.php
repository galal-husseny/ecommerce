@extends('layouts.admin')
@section('title', ' تعديل علامة تجارية')
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> تعديل علامة تجارية </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('brands.update',['id'=>$brand->id]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">ألاسم</label>
                <input type="text" name="name" value="{{$brand->name}}" class="form-control" id="text" placeholder="أكتب أسم العلامة التجارية">
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($brand->status == $value) value="{{ $value }}"> {{ $status }} </option>
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
            <button type="submit" name="edit" class="btn btn-primary">تعديل</button>
        </form>
    </div>
@endsection
