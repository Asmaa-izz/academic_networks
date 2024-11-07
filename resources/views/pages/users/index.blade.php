@extends('base')
@section('title', 'Users')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">Home</a>
    </li>
    <li class="breadcrumb-item text-gray-500">User</li>
@endsection

@section('action')
    @can('create', User::class)
        <a href="{{ route('users.create') }}" class="btn btn-primary fw-bold">Create new user</a>
    @endcan
@endsection

@section('content')
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="d-flex align-items-center position-relative  mb-5">
                <span class="svg-icon svg-icon-1 position-absolute me-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                 viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                        fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                       </span>
                <input type="text" data-kt-filter="search" class="form-control  w-250px pe-14"
                       placeholder="Search"/>
            </div>

            <div class="table-responsive">
                <table id="datatable_users" class="table table-row-bordered gy-5">
                    <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th class="text-end">Name</th>
                        <th class="text-end">Role</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td >
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
                            <td class="d-flex align-content-between ">
                                @if($user->hasRole('doctor'))
                                    <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 me-2">Doctor</span>
                                @else
                                    <span class="badge badge-light-warning fw-bold fs-8 px-2 py-1 me-2">Student</span>
                                @endif
                            </td>
                            <td class="text-start">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                   data-kt-menu-flip="top-end">
                                    actions
                                    <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                                </a>
                                <div
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                    data-kt-menu="true" style="">
                                    @can('update', $user)
                                        <div class="menu-item px-3">
                                            <a href="{{ route('users.edit', $user) }}" type="button"
                                               class="menu-link px-3">edit</a>
                                        </div>
                                    @endcan
                                    @can('delete', $user)
                                        <div class="menu-item px-3">
                                            <a href="" type="button" class="menu-link px-3" id="delete-user-link"
                                               data-bs-toggle="modal"
                                               data-bs-target="#delete-user-modal"
                                               data-id="{{$user->id}}" data-name="{{$user->name}}">delete</a>
                                        </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!--end::Card body-->
    </div>

    <div class="modal fade" tabindex="-1" id="delete-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete user</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="delete-user-form" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">

                        <div class="">
                            <h5>
                                <span>Are you sure delete user </span>
                                <span id="delete_message" class="text-danger"></span>
                                ؟
                            </h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-bs-dismiss="modal">Cansel
                        </button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script>
        // Class definition
        var KTDatatablesExample = function () {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function () {
                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    responsive: true,
                    ordering: false,
                    pagingType: "numbers",
                    processing: true,
                    paging: true,
                });
            }


            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#datatable_users');
                    initDatatable();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesExample.init();
        });

        $(document).on("click", "#delete-user-link", function () {
            console.log(0)
            let id = $(this).data('id');
            let name = $(this).data('name');
            console.log(name)
            $("#delete_message").text(`${name}`);
            $('#delete-user-form').attr('action', 'users/' + id);
        });
    </script>
@endsection
