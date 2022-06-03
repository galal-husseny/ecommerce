@extends('layouts.admin')
@section('title', "تعديل {$spec->name}")
@section('breadcrumb')
    {{ Breadcrumbs::render('specs.edit', $spec) }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('specs.update', ['spec' => $spec->id]) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-3">
                    <label for="text"> الصفة باللغة الانجليزية</label>
                    <input type="text" name="name[en]" value="{{ $spec->getTranslation('name','en') }}" class="form-control" id="text">
                </div>
                <div class="col-3">
                    <label for="text"> الصفة باللغة العربية</label>
                    <input type="text" name="name[ar]" value="{{ $spec->getTranslation('name','ar') }}" class="form-control" id="text">
                </div>
                <div class="col-3">
                    <label for="js-example-basic-hide-search-multi">القسم</label>
                    <select name="category_id[]" class="custom-select select2-container"
                        id="js-example-basic-hide-search-multi" multiple>
                        @foreach ($subcategories as $sub)
                            <option @selected(in_array($sub->id,$spec->categories()->pluck('category_id')->toArray()))  value="{{ $sub->id }}">
                                {{ $sub->getTranslation('name', 'en') }} -
                                {{ $sub->getTranslation('name', 'ar') }} </option>
                        @endforeach
                    </select>
                    <small class="text-warning font-weight-bold"> ctrl+click لأختيار أكثر من قسم
                    </small>
                </div>
            </div>

            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
