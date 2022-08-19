@extends('layouts.admin')
@section('title', "{$product->name}")
@push('css')
    <style></style>
@endpush
@section('breadcrumb')
    {{ Breadcrumbs::render('products.show', $product) }}
@endsection
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="col-12">
                    <h1 class="h1 text-center text-dark"> @yield('title') </h1>
                </div>
                @include('includes.validation-errors')
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        <div class="row my-4">
                            <div class="col-3">
                                <button class="btn btn-primary form-control bg-primary text-light" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne" id="product">
                                    المنتج
                                </button>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-outline-primary form-control" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                    id="specs">
                                    مُواصفات المنتج
                                </button>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-outline-primary form-control" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                    id="images">
                                    صور المنتج
                                </button>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-outline-primary form-control" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"
                                    id="reviews">
                                    التقيمات
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-12 mt-4">
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="nameen">الاسم بالانجليزي </label>
                                            <input readonly type="text" name="name[en]"
                                                value="{{ $product->getTranslation('name', 'en') }}" class="form-control"
                                                id="nameen">
                                        </div>
                                        <div class="col-6">
                                            <label for="namear">الاسم بالعربي </label>
                                            <input readonly type="text" name="name[ar]"
                                                value="{{ $product->getTranslation('name', 'ar') }}" class="form-control"
                                                id="namear">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="price"> السعر </label>
                                            <input readonly type="number" name="price" value="{{ $product->price }}"
                                                class="form-control" id="price">
                                        </div>
                                        <div class="col-6">
                                            <label for="quantity"> الكمية </label>
                                            <input readonly type="number" name="quantity" value="{{ $product->quantity }}"
                                                class="form-control" id="quantity">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-3">
                                            <label for="status">الحالة</label>
                                            <select disabled name="status" class="custom-select" id="status">
                                                @foreach ($statuses as $status => $value)
                                                    <option @selected($product->status == $value) value="{{ $value }}">
                                                        {{ $status }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="category_id">القسم</label>
                                            <select disabled name="category_id" class="custom-select" id="category_id">
                                                @foreach ($categories as $category)
                                                    <option @selected($product->category_id == $category->id)
                                                        nameValue="{{ $category->getTranslation('name', 'en') }}"
                                                        value="{{ $category->id }}">
                                                        {{ $category->getTranslation('name', 'en') }} -
                                                        {{ $category->getTranslation('name', 'ar') }}</option>
                                                @endforeach
                                            </select>
                                            <p id="category_error" class="text-danger font-weight-bold"></p>
                                        </div>
                                        <div class="col-3">
                                            <label for="model_id">موديل</label>
                                            <select disabled name="model_id" class="custom-select" id="model_id">
                                                @foreach ($models as $model)
                                                    <option @selected($product->model_id == $model->id)
                                                        nameValue="{{ $model->getTranslation('brand_name', 'en') }}"
                                                        value="{{ $model->id }}">
                                                        {{ $model->getTranslation('brand_name', 'ar') }} -
                                                        {{ $model->getTranslation('model_name', 'ar') }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-3">
                                            <label for="shop_id">التاجر والمحل</label>
                                            <select disabled name="shop_id" class="custom-select" id="shop_id">
                                                @foreach ($shops as $shop)
                                                    <option @selected($product->shop_id == $shop->id) value="{{ $shop->id }}">
                                                        {{ $shop->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12">
                                            <label for="descriptionen"> التفاصيل بالانجليزية </label>
                                            <textarea name="description[en]" class="form-control" id="descriptionen">{{ $product->getTranslation('description', 'en') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="descriptionar"> التفاصيل بالعربية </label>
                                            <textarea name="description[ar]" class="form-control" id="descriptionar">{{ $product->getTranslation('description', 'ar') }}</textarea>
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
                                                @foreach ($productSpecs as $productSpec)
                                                    <div data-repeater-item class="my-3">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="spec_id">الصفة</label>
                                                                <select disabled name="spec_id"
                                                                    class="custom-select spec_id" id="spec_id">
                                                                    @foreach ($specs as $spec)
                                                                        <option @selected($productSpec->id == $spec->id)
                                                                            value="{{ $spec->id }}">
                                                                            {{ $spec->getTranslation('name', 'ar') }}
                                                                            -
                                                                            {{ $spec->getTranslation('name', 'en') }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="text"> القيمة باللغة الانجليزية</label>
                                                                <input readonly type="text" name="en"
                                                                    class="form-control specValue" id="text"
                                                                    value="{{ $productSpec->getTranslation('value', 'en') }}">
                                                            </div>
                                                            <div class="col-3">
                                                                <label for="text"> القيمة باللغة العربية</label>
                                                                <input readonly type="text" name="ar"
                                                                    class="form-control specValue" id="text"
                                                                    value="{{ $productSpec->getTranslation('value', 'ar') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="row ">
                                        @foreach ($product->getMedia('products') as $index => $image)
                                            <div class="col-3">
                                                <img name="image" src="{{ asset($image->getUrl()) }}" class="w-100"
                                                    style="cursor: pointer" alt="صورة المنتج">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div id="collapseFour" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="row ">
                                        <div class="col-12">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th> الرقم </th>
                                                            <th> اسم المستخدم </th>
                                                            <th> الايميل </th>
                                                            <th> التقيم</th>
                                                            <th> التعليق </th>
                                                            <th> تاريخ الانشاء </th>
                                                            <th> تاريخ التعديل </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($product->reviews as  $review)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td> <a href="{{ route('users.edit', $review->pivot->user_id) }}"
                                                                        class="text-primary"> {{ $review->name }} </a>
                                                                </td>
                                                                <td>{{ $review->email }}</td>
                                                                <td>
                                                                    @for ($i = 1; $i <= $review->pivot->rate; $i++)
                                                                        <i class="fa fa-star text-warning"
                                                                            aria-hidden="true"></i>
                                                                    @endfor
                                                                    @for ($i = 1; $i <= 5 - $review->pivot->rate; $i++)
                                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                    @endfor


                                                                    ({{ $review->pivot->rate }})
                                                                </td>
                                                                <td>{{ $review->pivot->comment }} جنية</td>
                                                                <td>{{ $review->pivot->created_at }}</td>
                                                                <td>{{ $review->pivot->updated_at }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="8"
                                                                    class="alert alert-warning font-weight-bold text-center w-100">
                                                                    لايوجد
                                                                    تقيمات
                                                                    حاليا</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
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
            $('#reviews').removeClass('bg-primary text-light');
        });
        $('#specs').on('click', function() {
            $('#specs').toggleClass('bg-primary text-light');
            $('#product').removeClass('bg-primary text-light');
            $('#images').removeClass('bg-primary text-light');
            $('#reviews').removeClass('bg-primary text-light');
        });
        $('#images').on('click', function() {
            $('#images').toggleClass('bg-primary text-light');
            $('#product').removeClass('bg-primary text-light');
            $('#specs').removeClass('bg-primary text-light');
            $('#reviews').removeClass('bg-primary text-light');
        });
        $('#reviews').on('click', function() {
            $('#reviews').toggleClass('bg-primary text-light');
            $('#specs').removeClass('bg-primary text-light');
            $('#images').removeClass('bg-primary text-light');
            $('#product').removeClass('bg-primary text-light');
        });
    </script>
    <script>
        var options = "";
        var selectNameCounter = 0;
        $('#category_id').on('change', function() {
            var category_id = $('#category_id').val();
            specsRequest(category_id);
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
            $('.repeater').repeater({
                show: function() {
                    $(this).slideDown();
                    ++selectNameCounter;
                    // $('select[name="specs[' + selectNameCounter + '][spec_id]"]').html(options);
                }
            });
            var category_id = $('#category_id').val();
            // specsRequest(category_id);
        });
    </script>
    <script>
        $('img').on('click', function() {
            $('input readonly[name="' + this.name + '"]').click();
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
        $('#descriptionar').summernote("disable");
        $('#descriptionen').summernote("disable");
    </script>
    <script>
        $('.ProductImage').mouseenter(function() {
            $('.deleteProductImage[number="' + $(this).attr('number') + '"]').removeClass('d-none');
        });
        $('.ProductImage').mouseleave(function() {
            $('.deleteProductImage[number="' + $(this).attr('number') + '"]').addClass('d-none');
        });
        $('.deleteProductImage').click(function() {
            var product_id = {{ $product->id }};
            var media_id = $(this).attr('number');

            $.ajax({
                type: "post",
                url: "{{ url('api/v1/product/media/destroy/') }}",
                data: {
                    "product_id": product_id,
                    "media_id": media_id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    $('.ProductImage[number="' + media_id + '"]').addClass('d-none');
                },
                error: function(xhr, status, error) {
                    $('#sweetalert-03').click();
                }
            });
        });
    </script>
    <script>
        (function($) {
            $('#sweetalert-03').click(function(e) {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'حدث خظأ ما!'
                })
            });
        })(jQuery);
    </script>
@endpush
