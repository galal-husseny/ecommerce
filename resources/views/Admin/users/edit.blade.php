@extends('layouts.admin')
@section('title', " تعديل {$user->name}")
@section('breadcrumb')
    {{ Breadcrumbs::render('users.edit', $user) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <div id="example-form">
            <div>
                <h3>بياتات المستخدم</h3>
                <section>
                    <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="text">الأسم </label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                id="text">
                        </div>
                        <div class="form-group">
                            <label for="text">البريد الالكتروني </label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                id="text">
                        </div>
                        <div class="form-group">
                            <label for="email_verified_at">حالة البريد الالكتروني</label>
                            <select name="email_verified_at" class="custom-select" id="email_verified_at">
                                @foreach ($statuses as $status => $value)
                                    <option @selected($user->email_verified_at && $value == 1) @selected(!$user->email_verified_at && $value == 0)
                                        value="{{ $value }}">
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">الهاتف </label>
                            <input type="number" name="phone" value="{{ $user->phone }}" class="form-control"
                                id="phone">
                        </div>
                        <div class="form-group">
                            <label for="text">كلمة مرور </label>
                            <input type="password" name="password" value="" class="form-control" id="text">
                        </div>
                        <div class="form-group">
                            <label for="text">تأكيد كلمة مرور </label>
                            <input type="password" name="password_confirmation" value="" class="form-control"
                                id="text">
                        </div>
                        <div class="form-group">
                            <label for="status">الحالة</label>
                            <select name="status" class="custom-select" id="status">
                                @foreach ($statuses as $status => $value)
                                    <option @selected($user->email_verified_at && $value == 1) @selected(!$user->email_verified_at && $value == 0)
                                        value="{{ $value }}">
                                        {{ $status }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">النوع</label>
                            <select name="gender" class="custom-select" id="gender">
                                <option @selected($user->gender == 'm') value="m"> ذكر </option>
                                <option @selected($user->gender == 'f') value="f"> انثى </option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="row">
                                <div class="col-3">
                                    <input name="image" type="file" class="custom-file-input d-none"
                                        id="inputGroupFile01" onchange="previewImage(event)">
                                    <label for="inputGroupFile01"> <img for="inputGroupFile01" id="image"
                                            src="{{ $user->getFirstMediaUrl('users') ? asset($user->getFirstMediaUrl('users')) : asset('assets/admin/images/default.png') }}"
                                            class="w-100" alt="{{ $user->name }}" style="cursor: pointer"> </label>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-sm">تعديل</button>
                        </div>
                    </form>
                </section>
                <h3> العناوين ({{$user->addresses->count()}})</h3>
                <section>
                    <div class="row">
                        <table class="table center-aligned-table mb-0">
                            <thead>
                                <th>الرقم</th>
                                <th>الشارع</th>
                                <th>المبنى </th>
                                <th>الدور</th>
                                <th>الشقة</th>
                                <th>المنطقة</th>
                                <th>المدينة</th>
                                <th>الملاحظات</th>

                                <th>تاريخ الانشاء</th>
                                <th>تاريخ التعديل</th>
                                <th>العمليات</th>
                            </thead>
                            <tbody>
                                @forelse ($user->addresses as $address)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $address->street }}</td>
                                        <td>{{ $address->building }} </td>
                                        <td>{{ $address->floor }}</td>
                                        <td>{{ $address->flat }}</td>
                                        <td>{{ $address->region->getTranslation('name', 'ar') }} -
                                            {{ $address->region->getTranslation('name', 'en') }}</td>
                                        <td>{{ $address->region->city->getTranslation('name', 'ar') }} -
                                            {{ $address->region->city->getTranslation('name', 'en') }}</td>
                                        <td>{{ $address->notes }}</td>

                                        <td>{{ $address->created_at }}</td>
                                        <td> {{ $address->updated_at }}</td>
                                        <td>
                                            @if (can('Edit Addresses', 'admin'))
                                                <a href="{{ route('users.addresses.edit', ['user' => $user->id, 'address' => $address->id]) }}"
                                                    class="btn btn-outline-primary btn-sm">تعديل</a>
                                            @endif
                                            @if (can('Destroy Addresses', 'admin'))
                                                <form
                                                    action="{{ route('users.addresses.destroy', ['user' => $user->id, 'address' => $address->id]) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger btn-sm">حذف</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                <tr class="alert alert-warning text-center"><td colspan=11> لا توجد عناوين حاليا </td></tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if (can('Store Addresses', 'admin'))
                            <div class="col-12 mt-3">
                                <a href="{{ route('users.addresses.create', ['user' => $user->id]) }}"
                                    class="btn btn-primary rounded btn-sm"> إنشاء عنوان ل{{ $user->name }} </a>
                            </div>
                        @endif
                    </div>
                </section>
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
        var form = $("#example-form");
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "fade",
            enableAllSteps: true,
            enablePagination: false
        });
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
