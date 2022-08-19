@extends('layouts.admin')
@section('title', 'العروض')
@section('breadcrumb')
    {{ Breadcrumbs::render('offers.index') }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Offers', 'admin'))
        <div class="col-12">
            <a href="{{ route('offers.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء عرض </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th> العرض</th>
                        <th> التفاصيل</th>
                        <th>الخصم </th>
                        <th>الحالة</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>عدد المنتجات</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as  $offer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $offer->title }}</td>
                            <td>{!! $offer->description !!}</td>
                            <td>{{ $offer->max_discount }} </td>
                            <td><label
                                    class="badge badge-{{ $offer->status == 1 ? 'success' : 'danger' }}">{{ $offer->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>
                            </td>
                            <td>{{ $offer->start_at }}</td>
                            <td>{{ $offer->end_at }}</td>
                            <td>{{ $offer->products_count }}</td>
                            <td>{{ $offer->created_at }}</td>
                            <td>{{ $offer->updated_at }}</td>
                            <td>
                                @if (can('Update Offers', 'admin'))
                                    <a href="{{ route('offers.edit', ['offer' => $offer->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Offers', 'admin'))
                                    <form action="{{ route('offers.destroy', ['offer' => $offer->id]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif
                                <button type="button" data="{{ $offer->id }}" class="btn btn-outline-primary modal-btn"
                                    data-toggle="modal" data-target="#exampleModal">
                                    اضافة منتج
                                </button>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="alert alert-warning font-weight-bold text-center w-100">لايوجد
                                عروض
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Modal -->
            <form action="{{ route('offers.products.store') }}" method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">أضافة منتج لهذا العرض</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="offer_id" class="offer_id" value="">
                                <p id="product_error"></p>
                                <div class="repeater">
                                    <div data-repeater-list="products">
                                        <div data-repeater-item class="my-3">
                                            <input type="hidden" name="offer_id" class="offer_id" value="">
                                            <div class="row" id="product">
                                                <div class="col-6">
                                                    <label for="js-example-basic-hide-search-multi">المنتج</label>
                                                    <select name="product_id" class="form-control select2 product_id">
                                                        <option value="" disabled selected></option>
                                                        @foreach ($products as $product)
                                                            {{-- <option value="{{ $product->id }}">
                                                                {{ $product->getTranslation('name', 'en') }} -
                                                                {{ $product->getTranslation('name', 'ar') }}
                                                            </option> --}}
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-3">
                                                    <label for="product_discount"> نسبة الخصم (%) </label>
                                                    <input type="number" name="discount" class="form-control specValue"
                                                        id="product_discount">
                                                </div>
                                                {{-- <div class="col-lg-3">
                                                    <label for="delete"> ازالة</label>
                                                    <input class="btn btn-danger d-block" data-repeater-delete
                                                        type="button" value="مسح" id="delete" />
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <input class="button btn-success btn-lg my-5" id="add" data-repeater-create
                                        type="button" value="أضافة منتج" /> --}}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">حفظ </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/select2.js') }}"></script>
    <script>
        var offer_id;
        var selectedOptions = [];
        $('.modal-btn').click(function() {
            offer_id = $(this).attr('data');
            $('.offer_id').val(offer_id);
            getProducts(offer_id);
        });
        // $('.select2').on('select2:select', function (e) {
        //     var data = e.params.data;
        //     var selectedValue = data.id;
        //     selectedOptions = [];
        //     selectedOptions.push(selectedValue);
        //     console.log(selectedOptions);
        // });
    </script>
    <script>
        $(document).ready(function() {

            $(".select2").select2({
                allowClear: true,
            });
            $('.select2-container').width("100%");
            // $('.repeater, .repeater-file, .repeater-add').repeater({
            //     show: function() {
            //         $(this).show(function() {
            //             $(this).slideDown();
            //             $('.offer_id').val(offer_id);
            //             var data = [{id:1,text:"d"},{id:2,text:"a"}];
            //             $('.select2-container').remove();
            //             $(".select2").select2({
            //                 allowClear: true,
            //                 data:data
            //             });

            //             $('.select2-container').width("100%");
            //         });
            //         $('.select2').on('select2:select', function (e) {
            //                 console.log(e.params);
            //                 var data = e.params.data;
            //                 var selectedValue = data.id;
            //                 // selectedOptions = [];
            //                 selectedOptions.push(selectedValue);
            //                 console.log(selectedOptions);
            //                 console.log('inner');
            //             });
            //     },
            //     hide: function(remove) {
            //         if (confirm('Confirm Question')) {
            //             $(this).slideUp(remove);
            //         }
            //     }
            // });
        });
    </script>
    <script>
        function getProducts(offer_id) {
            $.ajax({
                type: "get",
                url: "{{ url('api/v1/products/except/offer/') }}",
                data: {
                    "id": offer_id
                },
                headers: {
                    "accept": "application/json","accept-language":'ar'
                },
                success: function(response, status) {
                    options = response.options;
                    products = response.products;
                    console.log(products);
                    $('.product_id').html(options);
                },
                error: function(xhr, status, error) {
                    $('#product_error').html(xhr.responseJSON.message);
                }
            });
        }
    </script>
@endpush
