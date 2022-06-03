@extends('layouts.admin')
@section('title', 'الموُاصفات')
@section('breadcrumb')
    {{ Breadcrumbs::render('specs.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Specs', 'admin'))
        <div class="col-12">
            <a href="{{ route('specs.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء صفات منتج </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th> الصفة باللغة العربية</th>
                        <th> الصفة باللغة الانجليزية</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($specs as  $spec)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $spec->getTranslation('name', 'ar') }}</td>
                            <td>{{ $spec->getTranslation('name', 'en') }}</td>
                            <td>{{ $spec->created_at }}</td>
                            <td>{{ $spec->updated_at }}</td>
                            <td>
                                @if (can('Update Specs', 'admin'))
                                    <a href="{{ route('specs.edit', ['spec' => $spec->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Specs', 'admin'))
                                    <form action="{{ route('specs.destroy', ['spec' => $spec->id]) }}" method="post"
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
                            <td colspan="7" class="alert alert-warning font-weight-bold text-center w-100">لايوجد
                                الموُاصفات
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

