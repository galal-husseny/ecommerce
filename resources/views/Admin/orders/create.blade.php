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
                                                {{$category->id}} -
                                                {{ $category->getTranslation('name', 'en') }} -
                                                {{ $category->getTranslation('name', 'ar') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 d-none brand_div">
                                    <label for="brand_id"> العلامة التجارية</label>
                                    <select name="brand_id" class="form-control select2 brand_id">
                                        <option value="" readonly></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">
                                                {{$brand->id}} -
                                                {{ $brand->getTranslation('name', 'en') }} -
                                                {{ $brand->getTranslation('name', 'ar') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 d-none model_div">
                                    <label for="model_id">  الموديل</label>
                                    <select name="model_id" class="form-control select2 model_id">
                                        <option value="" readonly></option>

                                    </select>
                                </div>
                                <div class="col-4 d-none product_div">
                                    <label for="product_id">المنتج</label>
                                    <select name="product_id" class="form-control select2">
                                    </select>
                                </div>
                                <div class="col-1 d-none product_div">
                                    <label for="quantity"> الكمية</label>
                                    <input type="number" name="quantity" class="form-control" id="quantity">
                                </div>
                                <div class="col-1">
                                    <label for=""> </label>
                                    <input class="btn btn-danger text-center btn-lg form-control" data-repeater-delete type="button"
                                        value="مسح" />
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <input class="button btn-success btn-lg my-5" id="add" data-repeater-create type="button"
                    value="أَضافة منتج جديد " />
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/select2.js') }}"></script>
    <script>
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
                    });
                },
                hide: function(remove) {
                    if (confirm('Confirm Question')) {
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
                }
            });


        });
    </script>
    <script>
        function getIndex(name){
            var startIndex = name.indexOf('[');
            var lastIndex = name.indexOf(']');
            var index = name.slice(++startIndex,lastIndex);
            return index;
        }
        function getProducts(element){
            var index = getIndex($(element)[0].name);
            var model_id = $(element).val();
            var category_id = $('select[name="products['+index+'][category_id]').val();
            products(category_id,model_id,index);
        }
         function products(category_id,model_id,index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/category/products/') }}",
                data: {
                    "category_id": category_id,
                    "model_id": model_id
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(response, status) {
                    $('select[name="products['+index+'][product_id]"]').html(response.options);
                    $('select[name="products['+index+'][product_id]"]').parent().removeClass('d-none');
                    $('.select2-container').width("100%");
                },
                error: function(xhr, status, error) {

                }
            });
        }
        function getModels(element){
            var brand_id = $(element).val();
            var index = getIndex($(element)[0].name);
            var category_id = $('select[name="products['+index+'][category_id]').val();
            models(brand_id,category_id,index);
        }
        function models(brand_id,category_id,index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/brand/models/') }}",
                data: {
                    "brand_id": brand_id,
                    "category_id": category_id
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(response, status) {
                    $('select[name="products['+index+'][model_id]"]').html(response.options);
                    $('select[name="products['+index+'][model_id]"]').parent().removeClass('d-none');
                $('.select2-container').width("100%");
                },
                error: function(xhr, status, error) {

                }
            });
        }
        function getBrands(element){
            var category_id = $(element).val();
            var index = getIndex($(element)[0].name);
            brands(category_id,index);
        }
        function brands(category_id,index) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/category/brands/') }}",
                data: {
                    "category_id": category_id
                },
                headers: {
                    "accept": "application/json"
                },
                success: function(response, status) {
                    $('select[name="products['+index+'][brand_id]"]').html(response.options);
                    $('select[name="products['+index+'][brand_id]"]').parent().removeClass('d-none');
                    $('.select2-container').width("100%");
                },
                error: function(xhr, status, error) {

                }
            });
        }
    </script>
@endpush
