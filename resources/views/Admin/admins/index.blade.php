@extends('layouts.admin')
@section('title', 'المُشرفين')
@section('breadcrumb')
    {{ Breadcrumbs::render('admins.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Admins','admin'))
        <div class="col-12">
            <a href="{{ route('admins.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء مُشرف </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم المُشرف</th>
                        <th> البريد الالكتروني</th>
                        <th>أسم الوظيفة</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as  $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->getRoleNames()->toArray()[0] }}</td> {{-- lazy loading --}}
                            <label class="badge badge-{{ $admin->status == 1 ? 'success' : 'danger' }}">{{ $admin->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>

                            <td>
                                <label class="badge badge-{{ $admin->email_verified_at ? 'success' : 'danger' }}">
                                {{ $admin->email_verified_at ? 'مُفعل' : 'غير مُفعل' }}
                                </label>
                            </td>
                            <td>{{ $admin->created_at }}</td>
                            <td>{{ $admin->updated_at }}</td>
                            <td>
                                @if (can('Update Admins','admin'))
                                    <a href="{{ route('admins.edit', ['admin' => $admin->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Admins','admin'))
                                    <form action="{{ route('admins.destroy', ['admin' => $admin->id]) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-outline-danger btn-sm">حذف</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="alert alert-warning font-weight-bold text-center w-100">لايوجد مُشرفين
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
