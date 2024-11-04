@extends('base')
@section('title', 'إنشاء مجموعة جديدة')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('groups.index') }}" class="text-gray-600 text-hover-primary  ms-2">المجموعات</a>
    </li>
    <li class="breadcrumb-item text-gray-500">إنشاء مجموعة جديدة</li>
@endsection

@section('content')
    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="card card-bordered min-h-100">
            <div class="card-header">
                <h3 class="card-title">إنشاء مجموعة جديدة</h3>
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
                        <label for="manager" class="form-label">مدير المجموعة</label>
                        <select id="manager" name="manager"
                                class="form-select @error('manager') is-invalid @enderror s2"
                                data-control="select2" data-placeholder="مدير المجموعة" data-allow-clear="">
                            <option></option>
                            @foreach($students as $manager)
                                <option class="role_option"
                                        value="{{ $manager->id }}"
                                    {{ old('manager') == $manager->id ? 'selected' : ''}}>
                                    {{ $manager->name }}</option>
                            @endforeach
                        </select>
                        @error('manager')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-12">
                        <label for="members" class="form-label">الأعضاء</label>
                        <select id="members" name="members[]"
                                class="form-select @error('members') is-invalid @enderror s2"
                                data-control="select2" data-placeholder="إختار الأعضاء"
                                data-allow-clear="true"
                                multiple="multiple">
                            @foreach($students as $member)
                                <option class="role_option"
                                        value="{{ $member->id }}"
                                    {{ (collect(old('members'))->contains( $member->id)) ? 'selected' : '' }}>
                                    {{ $member->name }}</option>
                            @endforeach
                        </select>
                        @error('members')
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
