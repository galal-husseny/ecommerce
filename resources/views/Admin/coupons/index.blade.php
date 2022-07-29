@extends('layouts.admin')
@section('title', 'أكواد الخصم')
@section('breadcrumb')
    {{ Breadcrumbs::render('coupons.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Coupons', 'admin'))
        <div class="col-12">
            <a href="{{ route('coupons.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء كود خصم </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th> كود الخصم</th>
                        <th> الخصم</th>
                        <th>نوع الخصم </th>
                        <th>أقصى قيمة للخصم (جنيه) </th>
                        <th> أقل سعر طلب لتفعيل الخصم (جنيه)</th>
                        <th> أقصى عدد مرات استخدام الخصم</th>
                        <th>عدد مستخدمين هذا الخصم حاليا</th>
                        <th> أقصى عدد مرات استخدام الخصم بالنسبة للمستخدم</th>
                        <th> نسبة تحمل الشركة</th>
                        <th>الحالة</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($coupons as  $coupon)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->discount }}{{ $coupon->discount_type == 'p' ? '%' : ' جنيه ' }} </td>
                            <td>{{ $coupon->discount_type == 'p' ? 'نسبة مئوية' : 'قيمة ثابتة' }}</td>
                            <td>{{ $coupon->max_discount_value }} جنيه</td>
                            <td>{{ $coupon->mini_order_price }} جنيه</td>
                            <td>{{ $coupon->max_usage_count }}</td>
                            <td> {{ $coupon->orders_count}}</td>
                            <td>{{ $coupon->max_usage_count_per_user }}</td>
                            <td>{{ $coupon->website_percentage }}%</td>
                            <td>
                                <label class="badge badge-{{ $coupon->status == 1 ? 'success' : 'danger' }}">{{ $coupon->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>
                            </td>
                            <td>{{ $coupon->start_at }}</td>
                            <td>{{ $coupon->end_at }}</td>
                            <td>{{ $coupon->created_at }}</td>
                            <td>{{ $coupon->updated_at }}</td>
                            <td>
                                @if (can('Update Coupons', 'admin'))
                                    <a href="{{ route('coupons.edit', ['coupon' => $coupon->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Coupons', 'admin'))
                                    <form action="{{ route('coupons.destroy', ['coupon' => $coupon->id]) }}" method="post"
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
                                أكواد خصم
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@endsection
