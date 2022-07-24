@extends('layouts.admin')
@section('title', ' أنشاء مُستخدم')
@section('breadcrumb')
    {{ Breadcrumbs::render('users.create') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-xl-12 mb-30">
        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" id="example-form">
                <input type="hidden" id="address_exist" name="address_exist" value="false">
            <div>
                <h3>بياتات المستخدم</h3>
                <section>
                    @csrf
                    <div class="form-group">
                        <label for="name">الأسم </label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكتروني </label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            id="email">
                    </div>
                    <div class="form-group">
                        <label for="email_verified_at">حالة البريد الالكتروني</label>
                        <select name="email_verified_at" class="custom-select" id="email_verified_at">
                            <option value="1">مفعل</option>
                            <option value="0">غير مفعل</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">الهاتف </label>
                        <input type="number" name="phone" value="{{ old('phone') }}" class="form-control"
                            id="phone">
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة مرور </label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                            id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">تأكيد كلمة مرور </label>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                            class="form-control" id="password_confirmation">
                    </div>
                    <div class="form-group">
                        <label for="status">حالة المستخدم</label>
                        <select name="status" class="custom-select" id="status">
                            @foreach ($statuses as $status => $value)
                                <option @selected(old('status') !== null && old('status') == $value) value="{{ $value }}">
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender">النوع</label>
                        <select name="gender" class="custom-select" id="gender">
                            <option @selected(old('gender') == 'm') value="m"> ذكر </option>
                            <option @selected(old('gender') == 'f') value="f"> انثى </option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="row">
                            <div class="col-3">
                                <input name="image" type="file" class="custom-file-input d-none" id="inputGroupFile01"
                                    onchange="previewImage(event)">
                                <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                                        src="{{ asset('assets/admin/images/default.png') }}" class="w-100"
                                        alt="الصورة الشخصية" style="cursor: pointer"> </label>

                            </div>
                        </div>
                    </div>
                </section>
                <h3>العناوين</h3>
                <section>
                    <div class="row">
                        <div class="col-4   mb-3">
                            <input class="form-control" name="address[street]" type="text" placeholder="الشارع" />
                        </div>
                        <div class="col-4   mb-3">
                            <input class="form-control" name="address[building]" type="text" placeholder="المبنى" />
                        </div>
                        <div class="col-4   mb-3">
                            <input class="form-control" name="address[floor]" type="text" placeholder="الدور" />
                        </div>
                        <div class="col-4  mb-3">
                            <input class="form-control" name="address[flat]" type="text" placeholder="شقة" />
                        </div>
                        <div class="col-4   mb-3">
                            <select name="address[region_id]" class="form-control" id="">
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
                        <input type="hidden" id="latitude" name="address[latitude]">
                        <input type="hidden" id="longitude" name="address[longitude]">
                        <div class="col-lg-12">
                            <div id="googleMap" name="map" style="width:100%;height:400px;" class="mb-4"></div>
                        </div>
                    </div>
                </section>
            </div>
        </form>

    </div>
    {{-- @include('includes.create-submit-buttons') --}}
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
        var form = $("#example-form");
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "fade",
            showFinishButtonAlways:true,
            labels: {
                finish: "انشاء",
                next: "التالي",
                previous: "السابق",
                loading: "تحميل ..."
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                $('#address_exist').val('true');
                return true;
            },
            // onFinishing: function(event, currentIndex) {
            //     form.validate().settings.ignore = ":disabled";
            //     return form.valid();
            // },
            onFinished: function(event, currentIndex) {
                form.submit();
            }
        });

        // $("#example-basic").steps({
        //     headerTag: "h3",
        //     bodyTag: "section",
        //     transitionEffect: "fade",
        //     autoFocus: true
        // });

        // $("#example-manipulation").steps({
        //     headerTag: "h3",
        //     bodyTag: "section",
        //     enableAllSteps: true,
        //     enablePagination: true
        // });

        // $("#example-vertical").steps({
        //     headerTag: "h3",
        //     bodyTag: "section",
        //     transitionEffect: "fade",
        //     stepsOrientation: "vertical"
        // });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyA_ByXqRRoZX8gjgRlUCGJ4F5Ot0THdkLc&callback=myMap">
    </script>
    <script>
        var marker;
        let markers = [];
        let removeMarkers = [];

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
                if (!marker || !marker.setPosition) {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                } else {
                    marker.setPosition(location);
                }
                var lat = location.lat();
                var lng = location.lng();
                $('#longitude').val(lng);
                $('#latitude').val(lat);
                marker.addListener("dblclick", function() {
                    marker.setMap(null);
                    marker = null;
                });
            }
            google.maps.event.addListener(map, "click", function(event) {
                placeMarker(event.latLng);
            });
        }
    </script>
@endpush
