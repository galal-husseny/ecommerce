@extends('layouts.admin')
@section('title', " تعديل {$shop->name}")
@section('breadcrumb')
    {{ Breadcrumbs::render('shops.edit', $shop) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('shops.update', ['shop' => $shop->id]) }}?seller_id={{$chooseSeller}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="latitude" name="latitude" value="{{ $shop->latitude }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $shop->longitude }}">
            <div class="form-group">
                <label for="text">أسم المحل </label>
                <input type="text" name="name" value="{{ $shop->name }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="street"> الشارع</label>
                <input type="text" name="street" value="{{ $shop->street }}" class="form-control" id="street">
            </div>
            <div class="form-group">
                <label for="building"> المبنى</label>
                <input class="form-control" name="building" value="{{ $shop->building }}" id="building" type="text" />
            </div>
            <div class="form-group">
                <label for="floor"> الدور</label>
                <input class="form-control" name="floor" value="{{ $shop->floor }}" id="floor" type="text" />
            </div>
            <div class="form-group">
                <label for="notes"> ملاحظات</label>
                <textarea name="notes" class="form-control" id="notes" cols="30" rows="10">{{$shop->notes}}</textarea>
            </div>
            <div class="form-group">
                <label for="region_id"> المنطقة</label>
                <select name="region_id" class="form-control" id="region_id">
                    @foreach ($regions as $region)
                        <option @selected($shop->region_id == $region->id) value="{{ $region->id }}">
                            {{ $region->name . '-' . $region->city->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if (!$chooseSeller)
                <div class="form-group">
                    <label for="seller_id">التاجر</label>
                    <select name="seller_id" class="custom-select" id="seller_id">
                        @foreach ($sellers as $seller)
                            <option @selected($shop->seller_id == $seller->id) value="{{ $seller->id }}"> {{ $seller->name }} </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group my-4">
                <div id="googleMap" name="map" style="width:100%;height:400px;" class="mb-4"></div>
            </div>
            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>

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
            const shopLatLng = {
                lat: {{ $shop->latitude }},
                lng: {{ $shop->longitude }}
            };
            console.log(shopLatLng);
            var marker = new google.maps.Marker({
                position: shopLatLng,
                map: map,
                title: "الفرع "
            });


            function placeMarker(location) {
                    marker.setPosition(null);
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
            google.maps.event.addListener(map, "click", function(event) {
                placeMarker(event.latLng);
            });
        }
    </script>
@endpush
