@php
$oldInputs = session()->getOldInput();
@endphp
@extends('layouts.admin')
@section('title', ' إنشاء صفات منتج')
@section('breadcrumb')
    {{ Breadcrumbs::render('specs.create') }}
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
        <form method="post" action="{{ route('specs.store') }}">
            @csrf
            <div class="repeater">
                <div data-repeater-list="specs">
                    <div data-repeater-item class="my-3">
                        @if (isset($oldInputs['specs']))
                            @foreach ($oldInputs['specs'] as $spec)
                                <div data-repeater-item class="my-3">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="text"> الصفة باللغة الانجليزية</label>
                                            <input type="text" name="en" value="{{ $spec['en'] }}" class="form-control"
                                                id="text">
                                        </div>
                                        <div class="col-3">
                                            <label for="text"> الصفة باللغة العربية</label>
                                            <input type="text" name="ar" value="{{ $spec['ar'] }}" class="form-control"
                                                id="text">
                                        </div>
                                        <div class="col-3">
                                            <label for="js-example-basic-hide-search-multi">القسم</label>
                                            <select name="category_id" class="custom-select select2-container"
                                                id="js-example-basic-hide-search-multi" multiple>
                                                @foreach ($subcategories as $sub)
                                                    <option
                                                        @isset($spec['category_id']) @selected(in_array($sub->id, $spec['category_id'])) @endisset
                                                        value="{{ $sub->id }}">
                                                        {{ $sub->getTranslation('name', 'en') }} -
                                                        {{ $sub->getTranslation('name', 'ar') }} </option>
                                                @endforeach
                                            </select>
                                            <small class="text-warning font-weight-bold"> ctrl+click لأختيار أكثر من قسم
                                            </small>
                                        </div>
                                        <div class="col-3">
                                            <label for=""> </label>
                                            <input class="btn btn-danger btn-lg form-control" data-repeater-delete
                                                type="button" value="مسح الصفة " />
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div data-repeater-item class="my-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="text"> الصفة باللغة الانجليزية</label>
                                        <input type="text" name="en" class="form-control" id="text">
                                    </div>
                                    <div class="col-3">
                                        <label for="text"> الصفة باللغة العربية</label>
                                        <input type="text" name="ar" class="form-control" id="text">
                                    </div>
                                    <div class="col-3">
                                        <label for="js-example-basic-hide-search-multi">القسم</label>
                                        <select name="category_id" class="custom-select select2-container"
                                            id="js-example-basic-hide-search-multi" multiple>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}">
                                                    {{ $sub->getTranslation('name', 'en') }} -
                                                    {{ $sub->getTranslation('name', 'ar') }} </option>
                                            @endforeach
                                        </select>
                                        <small class="text-warning font-weight-bold"> ctrl+click لأختيار أكثر من قسم
                                        </small>
                                    </div>
                                    <div class="col-3">
                                        <label for=""> </label>
                                        <input class="btn btn-danger btn-lg form-control" data-repeater-delete type="button"
                                            value="مسح الصفة " />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                <input class="button btn-success btn-lg my-5" id="add" data-repeater-create type="button"
                    value="أَضافة صفة جديدة " />
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
