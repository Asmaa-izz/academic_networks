@extends('base')
@section('title', 'إضافة مستخدم جديدة')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('users.index') }}" class="text-gray-600 text-hover-primary  ms-2">المستخدمون</a>
    </li>
    <li class="breadcrumb-item text-gray-500">إضافة مستخدم جديدة</li>
@endsection

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="card card-bordered min-h-100">
            <div class="card-header">
                <h3 class="card-title">إضافة مستخدم جديدة</h3>
            </div>
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="name" class="required form-label">الاسم</label>
                        <input id="name" type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="الاسم" value="{{ old('name') }}"/>
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
                               placeholder="البريد الالكتروني" value="{{ old('name') }}"/>
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
                            <option value="doctor">دكتور</option>
                            <option value="student" selected>طالب</option>
                        </select>
                        @error('role')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row ">
                    <p>ملاحظة : كلمة المرور عند الانشاء تكون : "password"</p>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
                <a href="{{ url()->previous() }}" class="btn btn-light ms-5">إلغاء</a>
            </div>
        </div>
    </form>
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
