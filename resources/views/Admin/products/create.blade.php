@extends('layouts.admin')
@section('title', ' أنشاء منتج')
@section('breadcrumb')
    {{ Breadcrumbs::render('products.create') }}
@endsection
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
                    </div>
                    @include('includes.validation-errors')
                    <div class="col-12">
                        <div class="accordion" id="accordionExample">
                            <div class="row my-4">
                                <div class="col-4">
                                    <button class="btn btn-primary form-control bg-primary text-light" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne" id="product">
                                        المنتج
                                    </button>
                                </div>
                                <div class="col-4">
                                    @if (can('Store Specs', 'admin'))
                                        <button class="btn btn-outline-primary form-control" type="button"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo" id="specs">
                                            مُواصفات المنتج
                                        </button>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-outline-primary form-control" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree" id="images">
                                        صور المنتج
                                    </button>
                                </div>
                                <div class="col-12 mt-4">
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="form-row">
                                            <div class="col-6">
                                                <label for="nameen">الاسم بالانجليزي </label>
                                                <input type="text" name="name[en]" value="{{ old('name.en') }}"
                                                    class="form-control" id="nameen">
                                            </div>
                                            <div class="col-6">
                                                <label for="namear">الاسم بالعربي </label>
                                                <input type="text" name="name[ar]" value="{{ old('name.ar') }}"
                                                    class="form-control" id="namear">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-6">
                                                <label for="price"> السعر </label>
                                                <input type="number" name="price" value="{{ old('price') }}"
                                                    class="form-control" id="price">
                                            </div>
                                            <div class="col-6">
                                                <label for="quantity"> الكمية </label>
                                                <input type="number" name="quantity" value="{{ old('quantity') }}"
                                                    class="form-control" id="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-3">
                                                <label for="status">الحالة</label>
                                                <select name="status" class="custom-select" id="status">
                                                    @foreach ($statuses as $status => $value)
                                                        <option @selected(old('status') == $value) value="{{ $value }}">
                                                            {{ $status }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="category_id">القسم</label>
                                                <select name="category_id" class="custom-select" id="category_id">
                                                    @foreach ($categories as $category)
                                                        <option @selected(old('category_id') == $category->id) nameValue="{{$category->getTranslation('name', 'en')}}" value="{{ $category->id }}">
                                                            {{ $category->getTranslation('name', 'en') }} -
                                                             {{ $category->getTranslation('name', 'ar') }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="category_name" class="form-control"
                                                    id="category_name">
                                                <p id="category_error" class="text-danger font-weight-bold"></p>
                                            </div>
                                            <div class="col-3">
                                                <label for="model_id">موديل</label>
                                                <select name="model_id" class="custom-select" id="model_id">
                                                    @foreach ($models as $model)
                                                        <option @selected(old('model_id') == $model->id) nameValue="{{$model->getTranslation('brand_name', 'en')}}" value="{{ $model->id }}">
                                                            {{ $model->getTranslation('brand_name', 'ar') }} - {{ $model->getTranslation('model_name', 'ar') }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="brand_name" class="form-control"
                                                    id="brand_name">

                                            </div>
                                            <div class="col-3">
                                                <label for="shop_id">التاجر والمحل</label>
                                                <select name="shop_id" class="custom-select" id="shop_id">
                                                    @foreach ($shops as $shop)
                                                        <option @selected(old('shop_id') == $shop->id) value="{{ $shop->id }}">
                                                            {{ $shop->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <label for="descriptionen"> التفاصيل بالانجليزية </label>
                                                <textarea name="description[en]" class="form-control" id="descriptionen">{{ old('description.en') }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label for="descriptionar"> التفاصيل بالعربية </label>
                                                <textarea name="description[ar]" class="form-control" id="descriptionar">{{ old('description.ar') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="form-group">
                                            <div class="repeater">
                                                <div data-repeater-list="specs">
                                                    <div data-repeater-item class="my-3">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="spec_id">الصفة</label>
                                                                <select name="spec_id" class="custom-select spec_id"
                                                                    id="spec_id">
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="text"> القيمة باللغة الانجليزية</label>
                                                                <input type="text" name="en"
                                                                    class="form-control specValue" id="text">
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="text"> القيمة باللغة العربية</label>
                                                                <input type="text" name="ar"
                                                                    class="form-control specValue" id="text">
                                                            </div>

                                                            <div class="col-lg-12">

                                                                <input class="btn btn-danger btn-lg" data-repeater-delete
                                                                    type="button" value="مسح الصفة" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="button btn-success btn-lg my-5" id="add"
                                                    data-repeater-create type="button" value="أضافة صفة" />
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="repeater-file">
                                            <div data-repeater-list="images">
                                                <div data-repeater-item>
                                                    <div class="row mb-20">
                                                        <div class="col-md-3">
                                                            {{-- <label for="customFile"> --}}
                                                            <img name="image"
                                                                src="{{ asset('assets/admin/images/default.png') }}"
                                                                class="w-100" style="cursor: pointer" alt="صورة المنتج">
                                                            {{-- </label> --}}
                                                            <input type="file" class="custom-file-input d-none"
                                                                id="customFile" name="image"
                                                                onchange="previewImage(event)" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="row my-5">
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control"
                                                                        name="width" id=""
                                                                        placeholder="اكتب العرض الجديد">
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control"
                                                                        name="height" id=""
                                                                        placeholder="اكتب الطول الجديد">
                                                                </div>
                                                            </div>
                                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                                type="button" value="مسح الصورة" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix">
                                                <input class="button" data-repeater-create type="button"
                                                    value="اضافة صورة" />
                                            </div>
                                        </div>
                                        <div class="my-5">
                                            @include('includes.create-submit-buttons')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $('#product').on('click', function() {
            $('#product').toggleClass('bg-primary text-light');
            $('#specs').removeClass('bg-primary text-light');
            $('#images').removeClass('bg-primary text-light');
        });
        $('#specs').on('click', function() {
            $('#specs').toggleClass('bg-primary text-light');
            $('#product').removeClass('bg-primary text-light');
            $('#images').removeClass('bg-primary text-light');
        });
        $('#images').on('click', function() {
            $('#images').toggleClass('bg-primary text-light');
            $('#product').removeClass('bg-primary text-light');
            $('#specs').removeClass('bg-primary text-light');
        });
    </script>
    <script>
        $(document).ready(function() {
            getCategoryName($('#category_id'));
            getBrandName($('#model_id'));
        });

        function getCategoryName(element) {
            var category_name = $(element).find('option:selected').attr('nameValue');
            $('#category_name').val(category_name);
        }

        function getBrandName(element) {
            var brand_name = $(element).find('option:selected').attr('nameValue');
            $('#brand_name').val(brand_name);
        }
    </script>
    <script>
        var options = "";
        var selectNameCounter = 0;
        $('#category_id').on('change', function() {
            var category_id = $('#category_id').val();
            getCategoryName(this);
            specsRequest(category_id);
        });
        $('#model_id').on('change', function() {
            getBrandName(this);
        });

        function specsRequest(id) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/category/specs/') }}",
                data: {
                    "id": id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    options = response.options;
                    $('.spec_id').html(options);
                },
                error: function(xhr, status, error) {
                    $('#category_error').html(xhr.responseJSON.message);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var category_id = $('#category_id').val();
            specsRequest(category_id);
            $('.repeater').repeater({
                show: function() {
                    $(this).slideDown();
                    ++selectNameCounter;
                    $('select[name="specs[' + selectNameCounter + '][spec_id]"]').html(options);
                }
            });
            $('.repeater-file').repeater({
                show: function() {
                    $(this).slideDown();
                    $('img').on('click', function() {
                        $('input[name="' + this.name + '"]').click();
                    });
                }
            });
        });
    </script>
    <script>
        $('img').on('click', function() {
            $('input[name="' + this.name + '"]').click();
        });
        var previewImage = function(event) {
            var imageName = event.srcElement.name;
            var output = document.getElementsByName(imageName)[0];
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
@endpush
