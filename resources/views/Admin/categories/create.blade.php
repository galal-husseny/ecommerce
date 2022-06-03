@extends('layouts.admin')
@section('title', ' أنشاء قسم')
@section('breadcrumb')
    {{ Breadcrumbs::render('categories.create') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="text">أسم القسم باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{ old('name.en') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="text">أسم القسم باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{ old('name.ar') }}" class="form-control" id="text">
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected(old('status') == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category"> مُتفرع من قسم</label>

                @php

                echo "<select name='category_id' class='custom-select' id='category'>
                    <option value=''> لايوجد </option>";
                $traverse = function ($categories, $prefix = '&nbsp') use (&$traverse) {
                    foreach ($categories as $category) {
                        $option =  "<option ";
                        if(is_null($category->parent_id)){
                            $option .= " style='font-weight:600;' ";
                        }
                        if(old('category_id') == $category->id){
                            $option .= " selected ";
                        }
                        $option.=" value='{$category->id}'>".$prefix.' '.$category->name .'</option>';
                        echo $option;
                        $traverse($category->children, $prefix.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                    }
                };

                $traverse($nodes);
                echo '</select>';
                @endphp
            </div>
            @include('includes.create-submit-buttons')
        </form>
    </div>
@endsection
