@extends('layouts.admin')
@section('title', " تعديل {$seller->name}")
@section('breadcrumb')
    {{ Breadcrumbs::render('sellers.edit', $seller) }}
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
                            <div class="col-6">
                                <button class="btn btn-primary form-control bg-primary text-light" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne" id="seller">
                                    التاجر
                                </button>
                            </div>
                            <div class="col-6">
                                @if (can('index Shops', 'admin'))
                                    <button class="btn btn-outline-primary form-control" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo" id="branches">
                                        المحلات
                                    </button>
                                @endif
                            </div>
                            <div class="col-12 mt-4">
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <form method="post" action="{{ url("admin/sellers/{$seller->id}") }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="text">الأسم </label>
                                            <input type="text" name="name" value="{{ $seller->name }}"
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">رقم البطاقة </label>
                                            <input type="text" name="national_id" value="{{ $seller->national_id }}"
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">الهاتف </label>
                                            <input type="text" name="phone" value="{{ $seller->phone }}"
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">البريد الالكتروني </label>
                                            <input type="email" name="email" value="{{ $seller->email }}"
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">كلمة مرور </label>
                                            <input type="password" name="password" value="" class="form-control"
                                                id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">تأكيد كلمة مرور </label>
                                            <input type="password" name="password_confirmation" value=""
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">النوع</label>
                                            <select name="gender" class="custom-select" id="gender">
                                                <option @selected($seller->gender == 'm') value="m">Male</option>
                                                <option @selected($seller->gender == 'f') value="f">Female</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">حالة التاجر</label>
                                            <select name="status" class="custom-select" id="status">
                                                @foreach ($statuses as $status => $value)
                                                    <option @selected($seller->status && $value == 1) @selected(!$seller->status && $value == 0)
                                                        value="{{ $value }}">
                                                        {{ $status }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">حالة البريد الالكتروني</label>
                                            <select name="email_verified_at" class="custom-select" id="status">
                                                @foreach ($statuses as $status => $value)
                                                    <option @selected($seller->email_verified_at && $value == 1) @selected(!$seller->email_verified_at && $value == 0)
                                                        value="{{ $value }}">
                                                        {{ $status }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label for="socail_links">روابط مواقع التواصل الاجتماعي</label>
                                            <div class="repeater">
                                                <div data-repeater-list="social_links">
                                                    @foreach (json_decode($seller->social_links) as $social_link)
                                                        <div data-repeater-item>
                                                            <div class="row">
                                                                <div class="col-lg-10">
                                                                    <input class="form-control" name="social_link"
                                                                        type="text"
                                                                        placeholder="https://www.example/account.com"
                                                                        value="{{ $social_link->social_link }}" />
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <input class="btn btn-danger btn-block"
                                                                        data-repeater-delete type="button" value="Delete" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                                <div class="row mt-20">
                                                    <div class="col-12">
                                                        <input class="button" data-repeater-create type="button"
                                                            value="Add new" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <input name="image" type="file" class="custom-file-input d-none"
                                                        id="inputGroupFile01" onchange="previewImage(event)">
                                                    <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                                                            src="{{ $seller->getFirstMediaUrl('sellers') ? asset($seller->getFirstMediaUrl('sellers')) : asset('assets/admin/images/default.png') }}"
                                                            class="w-100" alt="{{ $seller->name }}"
                                                            style="cursor: pointer">
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
                                    </form>

                                </div>

                            </div>
                            <div class="col-12 mt-4">
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <table class="table table-striped">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>رقم المحل</th>
                                                <th>اسم المحل</th>
                                                <th>شارع المحل</th>
                                                <th>المبنى</th>
                                                <th>الدور</th>
                                                <th>ملاحظات</th>
                                                <th>المنطقه</th>
                                                <th>تاريخ الانشاء</th>
                                                <th>تاريخ التعديل</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seller->shops as $shop)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $shop->name }}</td>
                                                    <td>{{ $shop->street }}</td>
                                                    <td>{{ $shop->building }}</td>
                                                    <td>{{ $shop->floor }}</td>
                                                    <td>{{ $shop->notes }}</td>
                                                    <td>{{ $shop->region->name . '-' . $shop->region->city->name }}
                                                    </td>
                                                    <td>{{ $shop->created_at }}</td>
                                                    <td>{{ $shop->updated_at }}</td>
                                                    <td>
                                                        @if (can('Edit Shops', 'admin'))
                                                            <a href="{{ route('shops.edit', ['shop' => $shop->id]) }}?seller_id={{ $seller->id }}"
                                                                class="btn btn-outline-primary btn-sm">تعديل</a>
                                                        @endif
                                                        @if (can('Destroy Shops', 'admin'))
                                                            <form
                                                                action="{{ route('shops.destroy', ['shop' => $shop->id]) }}"
                                                                method="post" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-outline-danger btn-sm">حذف</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if (can('Store Shops', 'admin'))
                                        <div class="col-12">
                                            <a href="{{ route('shops.create') }}?seller_id={{ $seller->id }}"
                                                class="btn btn-primary rounded btn-sm my-3"> أنشاء محل </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            $('#seller').on('click', function() {
                $('#seller').toggleClass('bg-primary text-light');
                $('#branches').removeClass('bg-primary text-light');
            });
            $('#branches').on('click', function() {
                $('#branches').toggleClass('bg-primary text-light');
                $('#seller').removeClass('bg-primary text-light');
            });
        </script>
    @endpush
