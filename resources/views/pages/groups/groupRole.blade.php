@extends('base')
@section('title', $group->name)
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">Home</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('groups.index') }}" class="text-gray-600 text-hover-primary  ms-2">Groups</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('groups.show', $group) }}"
           class="text-gray-600 text-hover-primary  ms-2">{{ $group->name }}</a>
    </li>
    <li class="breadcrumb-item text-gray-500">Roles</li>
@endsection

@section('content')
    <form action="{{ route('groups.role.update', $group) }}" method="POST">
        @csrf
        <div class="card card-bordered min-h-100">
            <div class="card-header">
                <h3 class="card-title">{{ 'Role student in group ' . $group->name }}</h3>
            </div>
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>member</th>
                            <th class="text-start">write post</th>
                            <th class="text-start">write comment</th>
                            <th class="text-start">share content</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img src="{{ asset($user->avatar) }}" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('users.show', $user) }}"
                                               class="text-dark fw-bolder text-hover-primary fs-6">{{ $user->name }}</a>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="on" id="flexCheckDefault"
                                               name="data[{{$user->id}}][post]" {{$user->pivotData($group->id) && $user->pivotData($group->id)->is_write_post ? 'checked' : '' }}/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="on" id="flexCheckDefault"
                                               name="data[{{$user->id}}][comment]" {{ $user->pivotData($group->id) && $user->pivotData($group->id)->is_write_comment ? 'checked' : '' }}/>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="on" id="flexCheckDefault"
                                               name="data[{{$user->id}}][content]" {{ $user->pivotData($group->id) && $user->pivotData($group->id)->is_share_content ? 'checked' : '' }}/>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-light ms-5">Cansel</a>
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
