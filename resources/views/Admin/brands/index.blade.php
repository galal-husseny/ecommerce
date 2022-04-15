@extends('layouts.admin')
@section('title', 'العلامات التجارية')
@section('breadcrumb')
    {{Breadcrumbs::render('brands.index')}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    <div class="col-12">
        <a href="{{ route('brands.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء علامة تجارية </a>
    </div>
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم العلامة التجارية باللغة العربية</th>
                        <th>أسم العلامة التجارية باللغة الانجليزية</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as  $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $brand->getTranslation('name','ar') }}</td>
                            <td>{{ $brand->getTranslation('name','en') }}</td>
                            <td><label class="badge badge-{{ $brand->status == 1 ? 'success' : 'danger' }}">{{ $brand->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>
                            </td>
                            <td>{{ $brand->created_at }}</td>
                            <td>{{ $brand->updated_at }}</td>
                            <td><a href="{{route('brands.edit',['brand' => $brand->id])}}" class="btn btn-outline-primary btn-sm">تعديل</a>
                                <form action="{{route('brands.destroy',['brand' => $brand->id])}}" method="post" class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-outline-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="alert alert-warning font-weight-bold text-center w-100">لايوجد علامات تجارية
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection