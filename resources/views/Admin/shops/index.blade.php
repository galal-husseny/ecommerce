@extends('layouts.admin')
@section('title', 'المحلات')
@section('breadcrumb')
    {{ Breadcrumbs::render('shops.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Shops', 'admin'))
    <div class="col-12">
        <a href="{{ route('shops.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء محل </a>
    </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم المحل</th>
                        <th>التاجر</th>
                        <th>الشارع</th>
                        <th>المبنى</th>
                        <th>الدور</th>
                        <th>ملاحظات</th>
                        <th>المنطقة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($shops as  $shop)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shop->name }}</td>
                            <td>{{ $shop->seller->name }}</td>
                            <td>{{ $shop->street }}</td>
                            <td>{{ $shop->building }}</td>
                            <td>{{ $shop->floor }}</td>
                            <td>{{ $shop->notes }}</td>
                            <td>{{ $shop->region->name . '-' . $shop->region->city->name }}</td>
                            <td>
                                @if (can('Update Shops', 'admin'))
                                    <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Shops', 'admin'))
                                    <form action="{{ route('shops.destroy', ['shop' => $shop->id]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="alert alert-warning font-weight-bold text-center w-100">لايوجد محلات
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
