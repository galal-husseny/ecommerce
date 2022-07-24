@extends('layouts.admin')
@section('title', ' أنشاء عرض')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('offers.create') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-xl-12 mb-30">
        <form method="post" action="{{ route('offers.store') }}" enctype="multipart/form-data" id="example-form">
            <div>
                <h3>بيانات العرض</h3>
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="title.ar">العنوان بالعربية </label>
                        <input type="text" name="title[ar]" value="{{ old('title.ar') }}" class="form-control"
                            id="title.ar">
                    </div>
                    <div class="col-6">
                        <label for="title.en">العنوان بالانجليزية </label>
                        <input type="text" name="title[en]" value="{{ old('title.en') }}" class="form-control"
                            id="title.en">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="max_discount"> نسبة الخصم </label>
                        <input type="number" name="max_discount" value="{{ old('max_discount') }}" class="form-control"
                            id="max_discount">
                    </div>
                    <div class="col-4">
                        <label for="start_at"> تاريخ بدء العرض </label>
                        <input type="datetime-local" name="start_at" value="{{ old('start_at') }}" class="form-control"
                            id="start_at">
                    </div>
                    <div class="col-4">
                        <label for="end_at"> تاريخ انتهاء العرض </label>
                        <input type="datetime-local" name="end_at" value="{{ old('end_at') }}" class="form-control"
                            id="end_at">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="descriptionar"> التفاصيل بالعربية </label>
                        <textarea name="description[ar]" class="form-control" id="descriptionar">{{ old('description.ar') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label for="descriptionen"> التفاصيل بالانجليزية </label>
                        <textarea name="description[en]" class="form-control" id="descriptionen">{{ old('description.en') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">الحالة </label>
                    <select name="status" class="custom-select" id="status">
                        @foreach ($statuses as $status => $value)
                            <option @selected(old('status') !== null && old('status') == $value) value="{{ $value }}">
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <div class="row">
                        <div class="col-3">
                            <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01"
                                onchange="previewImage(event)">
                            <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                                    src="{{ asset('assets/admin/images/default.png') }}" class="w-100" alt=" صورة العرض"
                                    style="cursor: pointer"> </label>

                        </div>
                    </div>
                </div>
                <h3>منتجات العرض</h3>
                <div class="form-group">
                    <div class="repeater">
                        <div data-repeater-list="products">
                            <div data-repeater-item class="my-3">
                                <div class="row" id="product">
                                    <div class="col-6">
                                        <label for="js-example-basic-hide-search-multi">المنتج</label>
                                        <select name="product_id" class="form-control select2">
                                            <option value="" disabled selected></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->getTranslation('name', 'en') }} -
                                                    {{ $product->getTranslation('name', 'ar') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-3">
                                        <label for="product_discount"> نسبة الخصم (%) </label>
                                        <input type="number" name="discount" class="form-control specValue"
                                            id="product_discount">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="delete"> ازالة</label>
                                        <input class="btn btn-danger d-block" data-repeater-delete type="button"
                                            value="مسح" id="delete" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="button btn-success btn-lg my-5" id="add" data-repeater-create type="button"
                            value="أضافة منتج" />
                    </div>
                </div>
                @include('includes.create-submit-buttons')

            </div>
        </form>

    </div>
@endsection

@push('js')
    <script>
        var previewImage = function(event) {
            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script>
        $('#descriptionen,#descriptionar').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true, // set focus to editable area after initializing summernote
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['insert', ['link', 'hr']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
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
                    });
                },
                hide: function(remove) {
                    if (confirm('Confirm Question')) {
                        $(this).slideUp(remove);
                    }
                }
            });

        });
    </script>
@endpush
