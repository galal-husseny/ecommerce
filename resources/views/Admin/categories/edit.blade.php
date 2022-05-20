@extends('layouts.admin')
@section('title', "تعديل {$category->name}")
@section('breadcrumb')
    {{Breadcrumbs::render('categories.edit',$category)}}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @include('includes.validation-errors')
    <div class="col-12">
        <form method="post" action="{{ route('categories.update',['category'=>$category->id]) }}" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="text">أسم القسم باللغة الانجليزية</label>
                <input type="text" name="name[en]" value="{{$category->getTranslation('name', 'en')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="text">أسم القسم باللغة العربية</label>
                <input type="text" name="name[ar]" value="{{$category->getTranslation('name', 'ar')}}" class="form-control" id="text" >
            </div>
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="custom-select" id="status">
                    @foreach ($statuses as $status => $value)
                        <option @selected($category->status == $value) value="{{ $value }}"> {{ $status }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category"> مُتفرع من قسم</label>
                @php
                echo "<select name='category_id' class='custom-select' id='category'>
                    <option value=''> لايوجد </option>";

                $traverse = function ($categories, $prefix = '&nbsp') use (&$traverse,$category) {
                    foreach ($categories as $cat) {
                        $option =  "<option ";
                        if(is_null($cat->parent_id)){
                            $option .= " style='font-weight:600;' ";
                        }
                        if(!is_null($category->parent) && $category->parent->id == $cat->id){
                            $option .= " selected ";
                        }
                        $option.=" value='{$cat->id}'>".$prefix.' '.$cat->name .'</option>';
                        echo $option;
                        $traverse($cat->children, $prefix.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                    }
                };
                $traverse($nodes);
                echo '</select>';
                @endphp
            </div>
            <button type="submit" name="edit" class="btn btn-primary my-3">تعديل</button>
        </form>
    </div>
@endsection
