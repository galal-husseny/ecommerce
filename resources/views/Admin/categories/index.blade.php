@extends('layouts.admin')
@section('title', 'الأقسام')
@section('breadcrumb')
    {{ Breadcrumbs::render('categories.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Categories', 'admin'))
        <div class="col-12">
            <a href="{{ route('categories.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء قسم </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم القسم باللغة العربية</th>
                        <th>أسم القسم باللغة الانجليزية</th>
                        <th>أسم القسم الرئيسي </th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as  $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->getTranslation('name', 'ar') }}</td>
                            <td>{{ $category->getTranslation('name', 'en') }}</td>
                            <td>{{ $category->parent ? $category->parent->getTranslation('name', 'ar').'-'.$category->parent->getTranslation('name', 'en') : ""}}</td>
                            <td><label
                                    class="badge badge-{{ $category->status == 1 ? 'success' : 'danger' }}">{{ $category->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>
                            </td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                @if (can('Update Categories', 'admin'))
                                    <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Categories', 'admin'))
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="alert alert-warning font-weight-bold text-center w-100">لايوجد أقسام حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
