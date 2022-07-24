@extends('layouts.admin')
@section('title', 'العناوين')
@section('breadcrumb')
    {{ Breadcrumbs::render('users.addresses.index',$user) }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    <div class="col-12">
        <div class="table-responsive mt-15">
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
    </div>
@endsection
