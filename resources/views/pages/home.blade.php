@php use Carbon\Carbon; Carbon::setLocale('ar'); @endphp
@extends('base')
@section('title', 'Home')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-500">Home</li>
@endsection

@section('content')
    @if(Auth::user()->hasRole('doctor'))
        <div class="row g-5 g-xl-8">
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <i class="ki-duotone ki-chart-simple text-gray-100 fs-2x ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                        <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ $doctor_count }}</div>
                        <div class="fw-semibold text-gray-100">Doctor</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <i class="ki-duotone ki-cheque text-gray-100 fs-2x ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                        </i>
                        <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">{{ $student_count }}</div>
                        <div class="fw-semibold text-gray-100">Student</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <i class="ki-duotone ki-briefcase text-white fs-2x ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $groups_count }}</div>
                        <div class="fw-semibold text-white">Group</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <i class="ki-duotone ki-chart-pie-simple text-white fs-2x ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $posts_count }}</div>
                        <div class="fw-semibold text-white">Post</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
        </div>
    @endif

    <div class="card mb-10">
        <div class="card-header">
            <h3 class="card-title pt-5 text-gray-700 ">All groups</h3>
        </div>
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
                       placeholder="search"/>
            </div>

            <div class="table-responsive">
                <table id="datatable_groups" class="table table-row-bordered gy-5">
                    <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th class="text-end">Name</th>
                        <th class="text-end">manager</th>
                        <th class="text-end">Member count</th>
                        <th>Join</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>
                                <a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a>
                            </td>
                            <td>
                                @if($group->getAdmin())
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-25px ms-3">
                                            <img src="{{asset($group->getAdmin()->avatar)}}" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('users.show', $group->getAdmin()) }}"
                                               class="text-dark fw-bolder text-hover-primary fs-6">{{ $group->getAdmin()->name }}</a>
                                        </div>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $group->users->count() }}</td>
                            <td>

                                @if(Auth::id() === $group->user_id)
                                    <span class="badge badge-light-primary">created group</span>
                                @else
                                    @if($group->users && (in_array(Auth::id() , $group->users->pluck('id')->toArray())))
                                        <span class="badge badge-light-success">member</span>
                                    @else
                                        @if($group->groupJoin->count() > 0)
                                            <span class="badge badge-secondary"> Waiting for approval</span>
                                        @else
                                            <form action="{{ route('group-join.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="group_id" value="{{ $group->id }}">
                                                <button type="submit" class="btn btn-light-primary">join</button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!--end::Card body-->
    </div>

    @if($groupsJoin->count() > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title pt-5 text-gray-700 ">Applications to join groups</h3>
            </div>
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
                           placeholder="search"/>
                </div>

                <div class="table-responsive">
                    <table id="datatable_groups" class="table table-row-bordered gy-5">
                        <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="text-end">Name</th>
                            <th class="text-end">Group</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupsJoin as $groupJoin)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px ms-5">
                                            <img src="{{ asset($groupJoin->userJoin->avatar) }}" alt="">
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="{{ route('users.show', $groupJoin->userJoin) }}"
                                               class="text-dark fw-bolder text-hover-primary fs-6">{{ $groupJoin->userJoin->name }}</a>
                                            <span
                                                class="text-muted fw-bold text-muted d-block fs-7">{{ $groupJoin->userJoin->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('groups.show', $groupJoin->group) }}">{{ $groupJoin->group->name }}</a>
                                </td>
                                <td>
                                    <form action="{{ route('group-join.update', $groupJoin) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-light-primary">Approval</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <!--end::Card body-->
        </div>
    @endif

@endsection

@section('script')
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

            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#table');
                    initDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesExample.init();
        });

    </script>

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
