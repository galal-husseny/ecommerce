@extends('layouts.admin')
@section('title', "تعديل {$role->name}")
@section('breadcrumb')
    {{Breadcrumbs::render('roles.edit',$role)}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('roles.update',['role'=>$role->id]) }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">أسم الوظيفة</label>
                <input type="text" name="name" value="{{$role->name}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="all">الصلاحيات</label>
                <input type="checkbox" name="" id="all">
                @foreach ($controller_permissions as $controller=>$permissions)
                    <p class="font-weight-bold">{{$controller}}</p>
                    @foreach ($permissions as $permission)
                        <label for="{{$permission->id}}">{{$permission->name}}</label>
                        <input @checked(in_array($permission->id,$role_permissions_ids)) type="checkbox" class="check-box" name="permission_id[]" value="{{$permission->id}}" id="{{$permission->id}}">
                    @endforeach
                   @endforeach
            </div>
            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
        </form>
    </div>
@endsection
