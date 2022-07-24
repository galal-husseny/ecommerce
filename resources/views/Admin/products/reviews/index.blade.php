@extends('layouts.admin')
@section('title', 'التقيمات')
@section('breadcrumb')
    {{ Breadcrumbs::render('reviews.index', $product) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th> الرقم </th>
                        <th> اسم المستخدم </th>
                        <th> الايميل </th>
                        <th> التقيم</th>
                        <th> التعليق </th>
                        <th> تاريخ الانشاء </th>
                        <th> تاريخ التعديل </th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product->reviews as  $review)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td> <a href="{{ route('users.edit', $review->pivot->user_id) }}" class="text-primary">
                                    {{ $review->name }} </a> </td>
                            <td>{{ $review->email }}</td>
                            <td>
                                @for ($i = 1; $i <= $review->pivot->rate; $i++)
                                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                @endfor
                                @for ($i = 1; $i <= 5 - $review->pivot->rate; $i++)
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                @endfor
                                ({{ $review->pivot->rate }})
                            </td>
                            <td>{{ $review->pivot->comment }} جنية</td>
                            <td>{{ $review->pivot->created_at }}</td>
                            <td>{{ $review->pivot->updated_at }}</td>
                            <td>
                                @if (can('Destroy Reviews', 'admin'))
                                    <form
                                        action="{{ route('reviews.destroy', ['product' => $review->pivot->product_id, 'user' => $review->pivot->user_id]) }}"
                                        method="post" class="d-inline">
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
                                تقيمات
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
