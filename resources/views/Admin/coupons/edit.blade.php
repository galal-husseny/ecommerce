@extends('layouts.admin')
@section('title', "تعديل كود ({$coupon->code}) "  )
@section('breadcrumb')
    {{ Breadcrumbs::render('coupons.edit', $coupon) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-xl-12 mb-30">
        <form method="post" action="{{ route('coupons.update', $coupon->id) }}"  >
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-3">
                    <label for="code">كود الخصم </label>
                    <input type="text" name="code" value="{{ $coupon->code }}" class="form-control" id="code">
                </div>
                <div class="col-3">
                    <label for="discount"> الخصم </label>
                    <input type="number" name="discount" value="{{ $coupon->discount }}" class="form-control" id="discount">
                </div>
                <div class="col-3">
                    <label for="discount_type"> نوع الخصم </label>
                    <select name="discount_type" id="discount_type" class="form-control">
                        <option @selected($coupon->discount_type == 'f') value="f"> قيمة ثابتة</option>
                        <option @selected($coupon->discount_type == 'p') value="p">نسبة مئوية</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="website_percentage"> (%) نسبة تحمل الشركة </label>
                    <input type="number" min="0" max="100" step="0.1" name="website_percentage" value="{{ $coupon->website_percentage }}"
                        class="form-control" id="website_percentage">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-4">
                    <label for="status">الحالة </label>
                    <select name="status" class="custom-select" id="status">
                        @foreach ($statuses as $status => $value)
                            <option @selected($coupon->status == $value) value="{{ $value }}">
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="start_at"> تاريخ تفعيل الكود </label>
                    <input type="datetime-local" name="start_at" value="{{$coupon->start_at }}" class="form-control"
                        id="start_at">
                </div>
                <div class="col-4">
                    <label for="end_at"> تاريخ انتهاء الكود </label>
                    <input type="datetime-local" name="end_at" value="{{ $coupon->end_at }}" class="form-control"
                        id="end_at">
                </div>
            </div>
            <div class="form-row my-3">
                <div class="col-3">
                    <label for="max_discount_value"> أقصى قيمة للخصم </label>
                    <input type="number" name="max_discount_value" class="form-control" id="max_discount_value"
                        value="{{$coupon->max_discount_value  }}">
                    <small>* مطلوب في حالة النسبة المئوية فقط</small>
                </div>
                <div class="col-3">
                    <label for="mini_order_price"> أقل سعر طلب لتفعيل الخصم </label>
                    <input type="number" name="mini_order_price" class="form-control" id="mini_order_price"
                        value="{{ $coupon->mini_order_price  }}">
                </div>
                <div class="col-3">
                    <label for="max_usage_count"> أقصى عدد مرات استخدام الخصم</label>
                    <input type="number" name="max_usage_count" class="form-control" id="max_usage_count"
                        value="{{ $coupon->max_usage_count  }}">
                </div>
                <div class="col-3">
                    <label for="max_usage_count_per_user"> أقصى عدد مرات استخدام الخصم للمستخدم </label>
                    <input type="number" name="max_usage_count_per_user" class="form-control" id="max_usage_count_per_user"
                        value="{{ $coupon->max_usage_count_per_user  }}">
                </div>
            </div>
            <button class="btn btn-primary"> تعديل</button>
        </form>
    </div>
@endsection


