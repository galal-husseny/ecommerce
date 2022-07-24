@extends('layouts.admin')
@section('title', 'المنتجات')
@section('breadcrumb')
    {{ Breadcrumbs::render('products.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Products', 'admin'))
        <div class="col-12">
            <a href="{{ route('products.create') }}" class="btn btn-primary rounded btn-sm"> أنشاء منتج </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th> الرقم </th>
                        <th> الكود </th>
                        <th> الاسم باللغة العربية</th>
                        <th> الاسم باللغة الانجليزية</th>
                        <th> السعر </th>
                        <th> الكمية </th>
                        <th> الحالة </th>
                        <th> الموديل </th>
                        <th> القسم </th>
                        <th> التاجر </th>
                        <th> تاريخ الانشاء </th>
                        <th> تاريخ التعديل </th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as  $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->getTranslation('name', 'ar') }}</td>
                            <td>{{ $product->getTranslation('name', 'en') }}</td>
                            <td>{{ $product->price }} جنية</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status }}</td>
                            <td>{{ $product->getTranslation('model_name', 'ar') }} - {{ $product->getTranslation('brand_name', 'ar') }}</td>
                            <td>{{ $product->getTranslation('category_name', 'ar') }}</td>
                            <td>{{ $product->seller_name}} - {{ $product->shop_name }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                @if (can('Show Products', 'admin'))
                                    <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                        class="btn btn-outline-primary btn-sm">عرض</a>
                                @endif
                                @if (can('Index Reviews', 'admin'))
                                    <a href="{{ route('reviews.index', ['product' => $product->id]) }}"
                                        class="btn btn-outline-primary btn-sm">التقيمات</a>
                                @endif
                                @if (can('Update Products', 'admin'))
                                    <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Products', 'admin'))
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="alert alert-warning font-weight-bold text-center w-100">لايوجد
                                مُنتجات
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
