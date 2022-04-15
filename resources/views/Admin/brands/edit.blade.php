@extends('layouts.admin')
@section('title', "تعديل {$brand->name}")
@section('breadcrumb')
    {{Breadcrumbs::render('brands.edit',$brand)}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('brands.update',['brand'=>$brand->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">أسم العلامة التجارية باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{$brand->getTranslation('name', 'en')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">أسم العلامة التجارية باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{$brand->getTranslation('name', 'ar')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($brand->status == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-3">
                    <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01" onchange="previewImage(event)">
                    <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image" src="{{asset($brand->getFirstMediaUrl('brands'))}}" class="w-100" alt="{{$brand->name}}" style="cursor: pointer"> </label>
                </div>
            </div>
            <div class="form-group">
                <input @checked(old('resize') === 'true') name='resize' type="checkbox" id="resize" value="true">
                <label for="resize">تغير أبعاد الصورة</label>
                <div id="resizebox" class="row d-none">
                    <div class="col-2">
                        <input type="text"  name="width" value="{{old('width')}}" class="form-control" id="text" placeholder="العرض">
                    </div>
                    <div class="col-2">
                        <input type="text"  name="height" value="{{old('height')}}" class="form-control" id="text" placeholder="الطول">
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
        $('#resize').on('change',function(){
           $('#resizebox').toggleClass('d-none');
        });
    </script>
@endpush
