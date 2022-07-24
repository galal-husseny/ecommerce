@extends('layouts.admin')
@section('title', ' أنشاء عنوان ل'.$user->name)
@section('breadcrumb')
    {{ Breadcrumbs::render('users.addresses.create',$user) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{route('users.addresses.store',['user'=>$user])}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

            <div class="form-group">
                <label for="street"> الشارع</label>
                <input type="text" name="street" value="{{ old('street') }}" class="form-control" id="street">
            </div>
            <div class="form-group">
                <label for="building"> المبنى</label>
                <input class="form-control" name="building" value="{{ old('building') }}" id="building" type="text" />
            </div>
            <div class="form-group">
                <label for="floor"> الدور</label>
                <input class="form-control" name="floor" value="{{ old('floor') }}" id="floor" type="text" />
            </div>
            <div class="form-group">
                <label for="text"> الشقة </label>
                <input type="text" name="flat" value="{{ old('flat') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="notes"> ملاحظات</label>
                <textarea name="notes" class="form-control" id="notes" cols="30" rows="10">{{old('notes')}}</textarea>
            </div>
            <div class="form-group">
                <label for="region_id"> المنطقة</label>
                <select name="region_id" class="form-control" id="region_id">
                    @foreach ($regions as $region)
                        <option @selected(old('region_id') == $region->id) value="{{ $region->id }}">
                            {{ $region->name . '-' . $region->city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group my-4">
                <div id="googleMap" name="map" style="width:100%;height:400px;" class="mb-4"></div>
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyA_ByXqRRoZX8gjgRlUCGJ4F5Ot0THdkLc&callback=myMap">
    </script>

    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(30.120655, 31.352292),
                zoom: 15,
            };
            var map = new google.maps.Map(
                document.getElementById("googleMap"),
                mapProp
            );
            var marker;
            function placeMarker(location) {
                if (marker) {
                    marker.setPosition(location);
                } else {
                    marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        title: "الفرع ",
                    });
                    var lat = location.lat();
                    var lng = location.lng();
                    document.getElementById("latitude").value = location.lat();
                    document.getElementById("longitude").value = location.lng();
                }
            }
            google.maps.event.addListener(map, "click", function(event) {
                placeMarker(event.latLng);
            });
        }
    </script>
@endpush
