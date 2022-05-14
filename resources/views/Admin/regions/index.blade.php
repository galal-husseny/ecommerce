@extends('layouts.admin')
@section('title', 'المناطق')
@section('breadcrumb')
    {{ Breadcrumbs::render('regions.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Regions', 'admin'))
        <div class="col-12">
            <a href="{{ route('regions.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء منطقة </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم المنطقة باللغة العربية</th>
                        <th>أسم المنطقة باللغة الانجليزية</th>
                        <th>المدينة</th>
                        <th> خط عرض نقطة المنتصف</th>
                        <th> خط طول نقطة المنتصف </th>
                        <th>أبعد مسافة عن نقطة المنتصف</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($regions as  $region)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $region->getTranslation('name', 'ar') }}</td>
                            <td>{{ $region->getTranslation('name', 'en') }}</td>
                            <td></td>
                            <td>{{ $region->latitude }}</td>
                            <td>{{ $region->longitude }}</td>
                            <td>{{ $region->radius }}</td>
                            <td><label
                                    class="badge badge-{{ $region->status == 1 ? 'success' : 'danger' }}">{{ $region->status == 1 ? 'متاح التوصيل' : 'غير متاح التوصيل' }}</label>
                            </td>
                            <td>{{ $region->created_at }}</td>
                            <td>{{ $region->updated_at }}</td>
                            @if (can('Store Regions', 'admin'))
                                <td>
                                    @if (can('Update Regions', 'admin'))
                                        <a href="{{ route('regions.edit', ['region' => $region->id]) }}"
                                            class="btn btn-outline-primary btn-sm">تعديل</a>
                                    @endif
                                    @if (can('Destroy Regions', 'admin'))
                                        <form action="{{ route('regions.destroy', ['region' => $region->id]) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-outline-danger btn-sm">حذف</button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="alert alert-warning font-weight-bold text-center ">لايوجد مناطق
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
