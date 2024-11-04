@extends('base')
@section('title',  $user->name . 'تعديل على مستخدم')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('users.index') }}" class="text-gray-600 text-hover-primary  ms-2">المستخدمون</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('users.show', $user) }}" class="text-gray-600 text-hover-primary  ms-2">{{$user->name}}</a>
    </li>
    <li class="breadcrumb-item text-gray-500">تعديل</li>
@endsection

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card card-bordered">
            <div class="card-header">
                <h3 class="card-title"> {{ $user->name . 'تعديل على مستخدم' }}</h3>
            </div>
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="name" class="required form-label">الاسم</label>
                        <input id="name" type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="الاسم" value="{{ $user->name }}"/>
                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="email" class="required form-label">البريد الالكتروني</label>
                        <input id="email" type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="البريد الالكتروني" value="{{ $user->email }}"/>
                        @error('email')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="role" class="form-label">الصلاحية</label>
                        <select id="role" name="role"
                                class="form-select @error('role') is-invalid @enderror s2"
                                data-control="select2" data-placeholder="الصلاحية" data-allow-clear="">
                            <option value="doctor" {{ $user->hasRole('student') ? 'selected' : null }}>دكتور</option>
                            <option value="student" {{ $user->hasRole('student') ? 'selected' : null }}>طالب</option>
                        </select>
                        @error('role')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ url()->previous() }}" class="btn btn-light ms-5">إلغاء</a>
            </div>
        </div>
    </form>

    @can('update', $user)
        <form action="{{ route('users.change-password', $user) }}" method="POST" class="mt-10">
            @csrf
            @method('PUT')
            <div class="card card-bordered">
                <div class="card-header">
                    <h3 class="card-title">تغيير كلمة المرور</h3>
                </div>
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <div class="row mb-5">
                        <div class="col-12">
                            <label for="password" class="required form-label">كلمة المرور</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="كلمة المرور" value=""/>
                            @error('password')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-12">
                            <label for="password_confirmation" class="required form-label">تأكيد كلمة المرور</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   placeholder="تأكيد كلمة المرور" value=""/>
                            @error('password_confirmation')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">تغيير</button>
                    <a href="{{ url()->previous() }}" class="btn btn-light ms-5">إلغاء</a>
                </div>
            </div>
        </form>
    @endcan
@endsection

@section('script')
    @if(session('success'))
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.primary("{{ session('success') }}");
        </script>
    @endif
@endsection
