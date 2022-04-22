@extends('layouts.admin')
@section('title', ' أنشاء العلامات التجارية')
@section('breadcrumb')
    {{Breadcrumbs::render('brands.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('brands.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">أسم العلامة التجارية باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{old('name.en')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">أسم العلامة التجارية باللغة العربية</label>
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
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">رفع</span>
                </div>
                <div class="custom-file">
                    <input type="file" name='image' class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">أختار لوجو العلامة التجارية</label>
                </div>
            </div>
            <div class="form-group">
                <input  name='resize' type="checkbox" id="resize" value="exist">
                <label for="resize">تغير أبعاد الصورة</label>
                <div id="resizebox" class="row d-none" >
                    <div class="col-2">
                        <input type="number"  name="width" value="{{old('width')}}" class="form-control" id="text" placeholder="العرض">
                    </div>
                    <div class="col-2">
                        <input type="number"  name="height" value="{{old('height')}}" class="form-control" id="text" placeholder="الطول">
                    </div>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script>
        $('#resize').on('change',function(){
           $('#resizebox').toggleClass('d-none');
        });
    </script>
@endpush



