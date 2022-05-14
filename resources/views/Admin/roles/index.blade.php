@extends('layouts.admin')
@section('title', 'الوظائف')
@section('breadcrumb')
    {{Breadcrumbs::render('roles.index')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if(can('Store Roles','admin'))
    <div class="col-12">
            <a href="{{ route('roles.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء وظيفة جديدة </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم الوظيفة</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as  $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                {{-- @if($role->name != 'Super Admin') --}}
                                @if(can('Update Roles','admin'))
                                    <a href="{{route('roles.edit',['role' => $role->id])}}" class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if(can('Destroy Roles','admin'))

                                    <form action="{{route('roles.destroy',['role' => $role->id])}}" method="post" class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="alert alert-warning font-weight-bold text-center w-100">لايوجد وظائف
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
