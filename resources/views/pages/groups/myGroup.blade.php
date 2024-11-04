@extends('base')
@section('title', 'مجموعاتي')
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-gray-500">مجموعاتي</li>
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
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <!--end::Card body-->
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
