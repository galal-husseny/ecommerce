@extends('layouts.admin')
@section('title', ' أنشاء وظيفة')
@section('breadcrumb')
    {{Breadcrumbs::render('roles.create')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">أسم الوظيفة</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="all">الصلاحيات</label>
                <input type="checkbox" name="" id="all">
                @foreach ($controller_permissions as $controller=>$permissions)
                    <p class="font-weight-bold">{{$controller}}</p>
                    @foreach ($permissions as $permission)
                        <label for="{{$permission->id}}">{{$permission->name}}</label>
                        <input type="checkbox" class="check-box" name="permission_id[]" value="{{$permission->id}}" id="{{$permission->id}}">
                    @endforeach
                   @endforeach
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
<script>
    $('#all').change(function(){
        if(this.checked){
            $('.check-box').attr('checked','checked');
        }else{
            $('.check-box').removeAttr('checked');
        }
    });
</script>
@endpush


