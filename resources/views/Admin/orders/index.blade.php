@extends('layouts.admin')
@section('title', 'الطلبات')
@section('breadcrumb')
    {{ Breadcrumbs::render('orders.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Orders', 'admin'))
        <div class="col-12">
            <a href="{{ route('orders.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء طلب جديد </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>كود الطلب</th>
                        <th> الحالة</th>
                        <th> مجوع اسعار المنتجات</th>
                        <th> كوبون</th>
                        <th> السعر النهائي للطلب </th>
                        <th>عدد المنتجات</th>
                        <th>تاريخ الوصول</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as  $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->code }}</td>
                            <td><label @class([
                                'badge',
                                'badge-success'=> $order->status == 'تم الوصول',
                                'badge-danger'=> $order->status == 'ملغي',
                                'badge-primary'=> $order->status == 'جاري التجهيز',
                                'badge-warning'=> $order->status == 'تم الشحن'
                                ])
                                >
                                {{ $order->status }}
                                </label>
                        </td>
                            <td>{{ $order->total_price }} </td>
                            <td>{{ $order->coupon?->code }}</td>
                            <td>{{ $order->final_price }}</td>
                            <td> {{ $order->products_count}}</td>
                            <td>{{ $order->delivered_at }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                @if (can('Update Orders', 'admin'))
                                    <a href="{{ route('orders.edit', ['order' => $order->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Orders', 'admin'))
                                    <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="post"
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
                            <td colspan="15" class="alert alert-warning font-weight-bold text-center w-100">لايوجد
                                طلبات
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection


