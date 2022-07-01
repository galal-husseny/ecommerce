@extends('layouts.admin')
@section('title', 'المستخدمين')
@section('breadcrumb')
    {{ Breadcrumbs::render('users.index') }}
@endsection
@section('content')
    <div class="col-12">
        <h1 class="h1 text-center text-dark"> @yield('title') </h1>
    </div>
    @if (can('Store Users','admin'))
        <div class="col-12">
            <a href="{{ route('users.create') }}" class="btn btn-primary rounded btn-sm"> إنشاء مُستخدم </a>
        </div>
    @endif
    <div class="col-12">
        <div class="table-responsive mt-15">
            <table class="table center-aligned-table mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>الرقم</th>
                        <th>أسم المستخدم</th>
                        <th> البريد الالكتروني</th>
                        <th> توقيت التحقق من البريد </th>
                        <th>الهاتف</th>
                        <th>النوع</th>
                        <th>حالة المستخدم</th>
                        <th>تاريخ الانشاء</th>
                        <th>تاريخ التعديل</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as  $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td >
                                <label @class([
                                    'badge',
                                    'badge-success'=> !is_null($user->email_verified_at) ,
                                    'badge-danger'=> is_null($user->email_verified_at)
                                ])>
                                {{ $user->email_verified_at ?? "لم يتم التحقق" }} </label>
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->gender == 'm' ? 'ذكر' : 'انثى' }}</td>
                            <td>
                                <label @class([
                                'badge',
                                'badge-success'=> $user->status == 1,
                                'badge-danger'=> $user->status == 0
                            ])>{{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}</label>
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                @if (can('Update Users','admin'))
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                        class="btn btn-outline-primary btn-sm">تعديل</a>
                                @endif
                                @if (can('Destroy Users','admin'))
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post"
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
                            <td colspan="10" class="alert alert-warning font-weight-bold text-center w-100">لايوجد مُستخدمين
                                حاليا</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
