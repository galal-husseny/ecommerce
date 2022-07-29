@extends('layouts.admin')
@section('title', ' أنشاء كود خصم')
@section('breadcrumb')
    {{ Breadcrumbs::render('coupons.create') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-xl-12 mb-30">
        <form method="post" action="{{ route('coupons.store') }}" id="example-form">
            @csrf
            <div class="form-row">
                <div class="col-3">
                    <label for="code">كود الخصم </label>
                    <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="code">
                </div>
                <div class="col-3">
                    <label for="discount"> الخصم </label>
                    <input type="number" name="discount" value="{{ old('discount') }}" class="form-control" id="discount">
                </div>
                <div class="col-3">
                    <label for="discount_type"> نوع الخصم </label>
                    <select name="discount_type" id="discount_type" class="form-control">
                        <option @selected(old('discount_type') == 'f') value="f"> قيمة ثابتة</option>
                        <option @selected(old('discount_type') == 'p') value="p">نسبة مئوية</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="website_percentage"> (%) نسبة تحمل الشركة </label>
                    <input type="number" min="0" max="100" step="0.1" name="website_percentage" value="{{ old('website_percentage',100) }}"
                        class="form-control" id="website_percentage">
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-4">
                    <label for="status">الحالة </label>
                    <select name="status" class="custom-select" id="status">
                        @foreach ($statuses as $status => $value)
                            <option @selected(old('status') !== null && old('status') == $value) value="{{ $value }}">
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="start_at"> تاريخ تفعيل الكود </label>
                    <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" class="form-control"
                        id="start_at">
                </div>
                <div class="col-4">
                    <label for="end_at"> تاريخ انتهاء الكود </label>
                    <input type="datetime-local" name="end_at" value="{{ old('end_at') }}" class="form-control"
                        id="end_at">
                </div>
            </div>
            <div class="form-row my-3">
                <div class="col-3">
                    <label for="max_discount_value"> أقصى قيمة للخصم </label>
                    <input type="number" name="max_discount_value" class="form-control" id="max_discount_value"
                        value="{{ old('max_discount_value') }}">
                    <small>* مطلوب في حالة النسبة المئوية فقط</small>
                </div>
                <div class="col-3">
                    <label for="mini_order_price"> أقل سعر طلب لتفعيل الخصم </label>
                    <input type="number" name="mini_order_price" class="form-control" id="mini_order_price"
                        value="{{ old('mini_order_price') }}">
                </div>
                <div class="col-3">
                    <label for="max_usage_count"> أقصى عدد مرات استخدام الخصم</label>
                    <input type="number" name="max_usage_count" class="form-control" id="max_usage_count"
                        value="{{ old('max_usage_count') }}">
                </div>
                <div class="col-3">
                    <label for="max_usage_count_per_user"> أقصى عدد مرات استخدام الخصم للمستخدم </label>
                    <input type="number" name="max_usage_count_per_user" class="form-control" id="max_usage_count_per_user"
                        value="{{ old('max_usage_count_per_user',1) }}">
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>

    </div>
@endsection
