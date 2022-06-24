@extends('layouts.admin')
@section('title', 'التُجار')
@section('breadcrumb')
    {{ Breadcrumbs::render('sellers.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Sellers', 'admin'))
    <div class="col-12">
        <a href="{{ route('sellers.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء تاجر </a>
    </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم التاجر</th>
                        <th>الرقم القومي</th>
                        <th> الهاتف</th>
                        <th>حالة التاجر</th>
                        <th> البريد الالكتروني</th>
                        <th> حالة البريد الالكتروني</th>
                        <th>مواقع التواصل الاجتماعي</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sellers as  $seller)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $seller->name }}</td>
                            <td>{{ $seller->national_id }}</td>
                            <td>{{ $seller->phone }}</td>
                            <td>
                                <label class="badge badge-{{ $seller->status ? 'success' : 'danger' }}">
                                    {{ $seller->status ? 'مُفعل' : 'غير مُفعل' }}
                                </label>
                            </td>
                            <td>{{ $seller->email }}</td>
                            <td>
                                <label class="badge badge-{{ $seller->email_verified_at ? 'success' : 'danger' }}">
                                    {{ $seller->email_verified_at ? 'مُفعل' : 'غير مُفعل' }}
                                </label>
                            </td>
                            <td>
                                @foreach (json_decode($seller->social_links) as $link)
                                    <a class="h6" href="{{$link->social_link}}"  target="_blank"><i title="{{$link->social_link}}" class=" fa fa-{{str_ireplace('.com','',str_ireplace('www.','', parse_url($link->social_link,PHP_URL_HOST)))}}  fa-exclamation-triangle"></i></a>
                                @endforeach
                            </td>
                            <td>{{ $seller->created_at }}</td>
                            <td>{{ $seller->updated_at }}</td>
                            <td>
                                @if (can('Update Sellers', 'admin'))
                                <a href="{{ route('sellers.edit', ['seller' => $seller->id]) }}"
                                    class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Sellers', 'admin'))
                                <form action="{{ route('sellers.destroy', ['seller' => $seller->id]) }}" method="post"
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
                            <td colspan="10" class="alert alert-warning font-weight-bold text-center w-100">لايوجد تُجار
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
