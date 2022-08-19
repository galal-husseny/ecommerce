@php
$oldInputs = session()->getOldInput();
@endphp
@extends('layouts.admin')
@section('title', ' إنشاء طلب جديد')
@section('breadcrumb')
    {{ Breadcrumbs::render('orders.create') }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('orders.store') }}" id="form">
            @csrf
            <div class="repeater">
                <div data-repeater-list="products">
                    @if (isset($oldInputs['products']))
                        @foreach ($oldInputs['products'] as $spec)
                            <div data-repeater-item class="my-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="product_id">المنتج</label>
                                        <select name="product_id" class="form-control select2">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->getTranslation('name', 'en') }} -
                                                    {{ $product->getTranslation('name', 'ar') }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="category_id"> القسم</label>
                                        <select name="category_id" class="form-control select2">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->getTranslation('name', 'en') }} -
                                                    {{ $category->getTranslation('name', 'ar') }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-3">
                                        <label for="quantity"> الكمية</label>
                                        <input type="number" name="quantity" class="form-control" id="quantity">
                                    </div>
                                    <div class="col-3">
                                        <label for=""> </label>
                                        <input class="btn btn-danger btn-lg form-control" data-repeater-delete
                                            type="button" value="مسح المنتج " />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div data-repeater-item class="my-3">
                            <div class="row">
                                <div class="col-2">
                                    <label for="category_id"> القسم</label>
                                    <select name="category_id" class="form-control select2 category_id">
                                        <option value="" readonly></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->id }} -
                                                {{ $category->getTranslation('name', 'en') }} -
                                                {{ $category->getTranslation('name', 'ar') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 d-none brand_div">
                                    <label for="brand_id"> العلامة التجارية</label>
                                    <select name="brand_id" class="form-control select2 brand_id">
                                        <option value="" readonly></option>
                                    </select>
                                </div>
                                <div class="col-2 d-none model_div">
                                    <label for="model_id"> الموديل</label>
                                    <select name="model_id" class="form-control select2 model_id">
                                        <option value="" readonly></option>

                                    </select>
                                </div>
                                <div class="col-4 d-none product_div">
                                    <label for="product_id">المنتج</label>
                                    <select name="product_id" class="form-control select2 product_id">
                                    </select>
                                </div>
                                <div class="col-1 d-none product_div">
                                    <label for="quantity"> الكمية</label>
                                    <input type="number" name="quantity" min=1 class="form-control quantity">
                                </div>
                                <div class="col-1">
                                    <label for="" class="d-block text-danger"> مسح </label>
                                    <button class="close removeRow text-danger" data-repeater-delete style="float: initial;opacity:1;font-size:2rem;"
                                        type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <input class="btn btn-primary btn-lg my-5 " id="add" data-repeater-create type="button"
                    value="أَضافة منتج جديد " />
            </div>
            <div class="form-row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="user_id"> المستخدم</label>
                            <select name="user_id" class="form-control select2 user_id" id="user_id">
                                <option value="" readonly></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} -
                                        {{ $user->email }} -
                                        {{ $user->phone }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 my-5">
                            <div class="row d-none address">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-3 offset-1">
                    <div class="form-group">
                        <label for="total_price">السعر الكلي</label>
                        <div class="input-group mb-3">
                            <input type="number" name="total_price" id="total_price" class="form-control" disabled readonly
                                aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">جنية</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="coupon">كود الخصم </label>
                        <div class="input-group mb-3">
                            <input type="text" name="coupon" id="coupon" class="form-control"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary rounded-right" id="applyCoupon" type="button">تطبيق</button>
                                <button class="close text-danger rounded-right d-none"  type="button" style="opacity:1;font-size:2rem; cursor: pointer" id="removeCoupon"  aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <small class="text-success " id="coupon-success"> </small>
                        <small class="text-danger" id="coupon-error"> </small>
                    </div>
                    <div class="form-group">
                        <label for="final_price">السعر النهائي</label>
                        <div class="input-group mb-3">
                            <input type="number" name="final_price" id="final_price" class="form-control" disabled
                                readonly aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">جنية</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">طريقة الدفع</label>
                        <div class="row mt-1">
                        @foreach ($payments as $index=>$payment)
                            <label for="payment_id_{{$index}}" class="col-6">
                                <img style="cursor: pointer" class="@if( $loop->first) border border-primary @endif w-100 h-50 paymentImage" src="{{ $payment->getTranslation('type','en') == 'Credit Card' ? asset('25630-8-credit-card-visa-and-master-card-hd.png') : asset('—Pngtree—cash on delivery png_6271116.png')}}" alt="">
                            </label>
                            <input type="radio" class="d-none" name="payment_id" id="payment_id_{{$index}}" value="{{$payment->id}}">
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/select2.js') }}"></script>
    <script>
        var discount = null;
        $(document).ready(function() {
            $(".select2").select2({
                allowClear: true,
            });

            $('.repeater, .repeater-file, .repeater-add').repeater({
                show: function() {
                    $(this).show(function() {
                        $(this).slideDown();
                        $('.select2-container').remove();
                        $(".select2").select2({
                            allowClear: true
                        });
                        $('.select2-container').width("100%");

                        $('.category_id').on('select2:select', function(e) {
                            // getProducts(this);
                            getBrands(this);

                        });
                        $('.brand_id').on('select2:select', function(e) {
                            getModels(this);
                        });
                        $('.model_id').on('select2:select', function(e) {
                            getProducts(this);
                        });
                        $('.product_id').on('select2:select', function(e) {
                            var index = getIndex($(this)[0].name);
                            $('input[name="products[' + index + '][quantity]').val(1).attr('max',$(this).find(':selected').data('quantity'));
                            updateTotalPrice();
                        });
                        $('.quantity').on('input', function() {
                            maxLengthCheck(this);
                            updateTotalPrice();
                        });
                    });
                },
                hide: function(remove) {
                    if (confirm('هل تريد مسح المنتج')) {

                        $(this).slideUp(remove);
                    }
                },
                ready: function(setIndexes) {

                    $('.category_id').on('select2:select', function(e) {
                        getBrands(this);
                    });
                    $('.brand_id').on('select2:select', function(e) {
                        getModels(this);
                    });
                    $('.model_id').on('select2:select', function(e) {
                        getProducts(this);
                    });
                    $('.product_id').on('select2:select', function(e) {
                        var index = getIndex($(this)[0].name);
                        $('input[name="products[' + index + '][quantity]').val(1).attr('max',$(this).find(':selected').data('quantity'));
                        updateTotalPrice();
                    });
                    $('.quantity').on('input', function() {
                        maxLengthCheck(this);
                        updateTotalPrice();
                    });
                }
            });

            $('#user_id').on('select2:select', function(e) {
                getAddresses($(this).val());
            });

            $('#applyCoupon').on('click', function() {
                var code = $('#coupon').val();
                var user_id = $('#user_id').val();
                var total_price = $('#total_price').val();
                if (code != '' && user_id != '' && total_price != '') {
                    $.ajax({
                        type: "post",
                        url: "{{ url('api/v1/apply/coupon/') }}",
                        data: {
                            "code": code,
                            "user_id": user_id,
                            "total_price": total_price
                        },
                        headers: {
                            "accept": "application/json","accept-language":'ar'
                        },
                        success: function(response, status) {
                            var message = "تم تطبيق الخصم بنجاح بقيمة خصم"
                             +response.discount.discountValue +
                            " جنية";
                            discount = response.discount.discountValue;
                            $('#coupon-error').html("");
                            $('#coupon-success').html("");
                            $('#final_price').val("");
                            $('#coupon-success').html(message);
                            $('#final_price').val(response.discount.totalPriceAfterDiscount);
                            $('#applyCoupon').addClass('d-none');
                            $('#removeCoupon').removeClass('d-none');
                            $('#coupon').attr('readonly','readonly');
                        },
                        error: function(xhr, status, error) {
                            var message = xhr.responseJSON.errors.code[0];
                            $('#coupon-error').html("");
                            $('#coupon-success').html("");
                            $('#coupon-error').html(message);
                            $('#applyCoupon').addClass('d-none');
                            $('#removeCoupon').removeClass('d-none');
                            $('#coupon').attr('readonly','readonly');
                        }
                    });
                }
            });

            $('#removeCoupon').on('click', function() {
                $('#coupon-error').html("");
                $('#coupon-success').html("");
                $('#final_price').val("");
                $("#coupon").val("");
                $('#final_price').val($('#total_price').val());
                $(this).addClass('d-none');
                $('#applyCoupon').removeClass('d-none');
                $('#coupon').removeAttr('readonly');
            });

            $('.paymentImage').on('click',function(){
                $(this).addClass('border border-primary');
                $('.paymentImage').not(this).removeClass('border border-primary');
            });
        });
    </script>
    <script>
        function getIndex(name) {
            var startIndex = name.indexOf('[');
            var lastIndex = name.indexOf(']');
            var index = name.slice(++startIndex, lastIndex);
            return index;
        }

        function getProducts(element) {
            var index = getIndex($(element)[0].name);
            var model_id = $(element).val();
            var category_id = $('select[name="products[' + index + '][category_id]').val();
            products(category_id, model_id, index);
        }

        function products(category_id, model_id, index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/category/products/') }}",
                data: {
                    "category_id": category_id,
                    "model_id": model_id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    $('select[name="products[' + index + '][product_id]"]').html(response.options);
                    $('select[name="products[' + index + '][product_id]"]').parent().removeClass('d-none');
                    $('.select2-container').width("100%");
                    $('input[name="products[' + index + '][quantity]').val(1).attr('max',response.products[0].quantity).parent().removeClass('d-none');
                    updateTotalPrice();
                },
                error: function(xhr, status, error) {

                }
            });
        }

        function getModels(element) {
            var brand_id = $(element).val();
            var index = getIndex($(element)[0].name);
            var category_id = $('select[name="products[' + index + '][category_id]').val();
            models(brand_id, category_id, index);
        }

        function models(brand_id, category_id, index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/brand/models/') }}",
                data: {
                    "brand_id": brand_id,
                    "category_id": category_id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    $('select[name="products[' + index + '][model_id]"]').html(response.options);
                    $('select[name="products[' + index + '][model_id]"]').parent().removeClass('d-none');
                    $('.select2-container').width("100%");
                },
                error: function(xhr, status, error) {
                }
            });
        }

        function getBrands(element) {
            var category_id = $(element).val();
            var index = getIndex($(element)[0].name);
            brands(category_id, index);
        }

        function brands(category_id, index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/category/brands/') }}",
                data: {
                    "category_id": category_id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    $('select[name="products[' + index + '][brand_id]"]').html(response.options);
                    $('select[name="products[' + index + '][brand_id]"]').parent().removeClass('d-none');
                    $('.select2-container').width("100%");
                },
                error: function(xhr, status, error) {

                }
            });
        }

        function getAddresses(user_id) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/user/addresses/') }}",
                data: {
                    "user_id": user_id,
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    // add addresses in DOM
                    $('.address').html(response.addressCards).removeClass('d-none');
                },
                error: function(xhr, status, error) {

                }
            });
        }

        function updateTotalPrice() {
            var quantities = [];
            var prices = [];
            var subTotal = [];
            var total = 0;
            $('.quantity').each(function() {
                quantities.push($(this).val());
            });
            $('.product_id').each(function() {
                prices.push($(this).find(':selected').data('price'));
            });
            for (let index = 0; index < prices.length; index++) {
                subTotal.push(prices[index] * quantities[index]);
                total += prices[index] * quantities[index];
            }
            $('#total_price').val(total);
            if(discount != null){
                total -= discount;
            }
            $('#final_price').val(total);
        }

        function maxLengthCheck(object) {
            if (parseInt(object.value) > parseInt(object.max))
                object.value = object.value.slice(0,-1)
        }


    </script>
@endpush
