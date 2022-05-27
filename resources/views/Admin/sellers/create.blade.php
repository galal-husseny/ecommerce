@extends('layouts.admin')
@section('title', ' أنشاء تاجر')
@section('breadcrumb')
    {{ Breadcrumbs::render('sellers.create') }}
@endsection
@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ route('sellers.store') }}" enctype="multipart/form-data">
                    @csrf
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
                                    <button class="btn btn-outline-primary form-control" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo" id="branches">
                                        المحلات
                                    </button>
                                </div>
                                <div class="col-12 mt-4">
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="form-group">
                                            <label for="text">الأسم </label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="national_id">الرقم القومي </label>
                                            <input type="number" name="national_id" value="{{ old('national_id') }}"
                                                class="form-control" id="national_id">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">رقم الهاتف </label>
                                            <input type="number" name="phone" value="{{ old('phone') }}"
                                                class="form-control" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">البريد الالكتروني </label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">كلمة مرور </label>
                                            <input type="password" name="password" value="{{ old('password') }}"
                                                class="form-control" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">تأكيد كلمة مرور </label>
                                            <input type="password" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}" class="form-control"
                                                id="password_confirmation">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">النوع</label>
                                            <select name="gender" class="custom-select" id="gender">
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">حالة البريد الالكتروني</label>
                                            <select name="email_verified_at" class="custom-select" id="status">
                                                @foreach ($statuses as $status => $value)
                                                    <option @selected(old('status') == $value) value="{{ $value }}">
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">حالة التاجر</label>
                                            <select name="status" class="custom-select" id="status">
                                                @foreach ($statuses as $status => $value)
                                                    <option @selected(old('status') == $value) value="{{ $value }}">
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">رفع</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name='image' class="custom-file-input"
                                                    id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">الصورة الشخصية
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="socail_links">روابط مواقع التواصل الاجتماعي</label>
                                            <div class="repeater">
                                                <div data-repeater-list="social_links">
                                                    <div data-repeater-item>
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <input class="form-control" name="social_link" type="text"
                                                                    placeholder="https://www.example/account.com" />
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                                    type="button" value="مسح" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-20">
                                                    <div class="col-12">
                                                        <input class="button" data-repeater-create type="button"
                                                            value="أضافة رابط" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="form-group">
                                            <div class="repeater ">
                                                <div data-repeater-list="shop">
                                                    <div data-repeater-item class="my-3">
                                                        <div class="row">
                                                            <div class="col-4  mb-3">
                                                                <input class="form-control" name="name" type="text"
                                                                    placeholder="اسم المحل" />
                                                            </div>
                                                            <div class="col-4   mb-3">
                                                                <input class="form-control" name="street" type="text"
                                                                    placeholder="الشارع" />
                                                            </div>
                                                            <div class="col-4   mb-3">
                                                                <input class="form-control" name="building" type="text"
                                                                    placeholder="المبنى" />
                                                            </div>
                                                            <div class="col-4   mb-3">
                                                                <input class="form-control" name="floor" type="text"
                                                                    placeholder="الدور" />
                                                            </div>

                                                            <div class="col-4   mb-3">
                                                                <select name="region_id" class="form-control" id="">
                                                                    @foreach ($regions as $region)
                                                                        <option value="{{ $region->id }}">
                                                                            {{ $region->getTranslation('name', 'en') . '-' . $region->getTranslation('name', 'en') }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-4  mb-3">
                                                                <textarea name="notes" id="" cols="30" rows="1" class="form-control" placeholder="ملاحظات"></textarea>
                                                            </div>
                                                            <input type="hidden" name="latitude" id="latitude">
                                                            <input type="hidden" name="longitude" id="longitude">
                                                            <div class="col-lg-12">

                                                                <input class="btn btn-danger btn-lg" data-repeater-delete
                                                                    type="button" value="مسح الفرع" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="button btn-success btn-lg my-5" data-repeater-create
                                                    type="button" value="أضافة فرع" />
                                                <div id="googleMap" name="map" style="width:100%;height:400px;" class="mb-4"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                    </div>
                    <div class="col-12">


                        @include('includes.create-submit-buttons')
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyA_ByXqRRoZX8gjgRlUCGJ4F5Ot0THdkLc&callback=myMap">
    </script>

    <script>
        var markers = [];

        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(30.120655, 31.352292),
                zoom: 15,
            };
            var map = new google.maps.Map(
                document.getElementById("googleMap"),
                mapProp
            );

            function placeMarker(location) {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: "الفرع " + (markers.length + 1),
                });
                var lat = location.lat();
                var lng = location.lng();
                markers.push({
                    lat: lat,
                    lng: lng
                });

                for (let index = 0; index < markers.length; index++) {
                    document.getElementsByName(
                        "shop[" + index + "][latitude]"
                    )[0].value = markers[index].lat;
                    document.getElementsByName(
                        "shop[" + index + "][longitude]"
                    )[0].value = markers[index].lng;
                }
            }
            google.maps.event.addListener(map, "click", function(event) {
                placeMarker(event.latLng);
            });
        }
    </script>
@endpush
