@extends('base')
@section('title', 'المجموعات')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-gray-500">المجموعات</li>
@endsection

@section('action')
    @can('create', \App\Models\Group::class)
        <a href="{{ route('groups.create') }}" class="btn btn-primary fw-bold">إنشاء مجموعة جديدة</a>
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
                       placeholder="بحث"/>
            </div>

            <div class="table-responsive">
                <table id="datatable_groups" class="table table-row-bordered gy-5">
                    <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th class="text-end">الاسم</th>
                        <th class="text-end">مدير المجموعة</th>
                        <th class="text-end">عدد الأعضاء</th>
                        <th class="text-end">عدد المقالات</th>
                        <th>العمليات</th>
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
                                    لا يوجد
                                @endif
                            </td>
                            <td>{{ $group->users->count() }}</td>
                            <td>{{ $group->posts_count }}</td>
                            <td class="text-start">
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                   data-kt-menu-flip="top-end">
                                    العمليات
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
                                    @can('update', $group)
                                        <div class="menu-item px-3">
                                            <a href="{{ route('groups.edit', $group) }}" type="button"
                                               class="menu-link px-3">تعديل</a>
                                        </div>
                                    @endcan
                                    @can('delete', $group)
                                        <div class="menu-item px-3">
                                            <a href="" type="button" class="menu-link px-3" id="delete-group-link"
                                               data-bs-toggle="modal"
                                               data-bs-target="#delete-group-modal"
                                               data-id="{{$group->id}}" data-name="{{$group->name}}">حذف</a>
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

    <div class="modal fade" tabindex="-1" id="delete-group-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">حذف مجموعة</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <form id="delete-group-form" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">

                        <div class="">
                            <h5>
                                <span>هل أنت متأكد من عملية حذف مجموهة </span>
                                <span id="delete_message" class="text-danger"></span>
                                ؟
                            </h5>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-bs-dismiss="modal">إلغاء
                        </button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    language: {
                        "lengthMenu": `عدد النتائج في الصفحة` + "  _MENU_",
                        "zeroRecords": `لا توجد بيانات مطابقة`,
                        "info": "",
                        "infoEmpty": "",
                        "infoFiltered": "",
                        "processing": `الرجاء الإنتظار`,
                    }
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
                    table = document.querySelector('#datatable_groups');
                    initDatatable();
                    handleSearchDatatable();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesExample.init();
        });

        $(document).on("click", "#delete-group-link", function () {
            console.log(0)
            let id = $(this).data('id');
            let name = $(this).data('name');
            $("#delete_message").text(`${name}`);
            $('#delete-group-form').attr('action', 'groups/' + id);
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
