@php use Carbon\Carbon; Carbon::setLocale('ar'); @endphp
@extends('base')
@section('title', 'الرئيسية')

@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-500">الرئيسية</li>
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
                       <div class="fw-semibold text-gray-100">دكتور</div>
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
                       <div class="fw-semibold text-gray-100">طالب</div>
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
                       <div class="fw-semibold text-white">مجموعة</div>
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
                       <div class="fw-semibold text-white">منشور</div>
                   </div>
                   <!--end::Body-->
               </a>
               <!--end::Statistics Widget 5-->
           </div>
       </div>
   @endif

   <div class="row g-5 g-xl-8">
       <div class="col-xl-12">
           <!--begin::Table widget 12-->
           <div class="card card-flush h-xl-100">
               <!--begin::Header-->
               <div class="card-header pt-7">
                   <!--begin::Title-->
                   <h3 class="card-title align-items-start flex-column">
                       <span class="card-label fw-bold text-gray-800">الأنشطة الأخيرة</span>
                   </h3>
                   <!--end::Title-->
               </div>
               <!--end::Header-->
               <!--begin::Body-->
               <div class="card-body">
                   <!--begin::Table container-->
                   <div class="table-responsive">
                       <!--begin::Table-->
                       <table class="table table-row-dashed align-middle gs-0 gy-3 my-0" id="table">
                           <!--begin::Table head-->
                           <thead>
                           <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                               <th class="p-0 pb-3 min-w-175px text-end">الاسم</th>
                               <th class="p-0 pb-3 min-w-175px text-end">المجموعة</th>
                               <th class="p-0 pb-3 min-w-100px text-end">تاريخ الاضافة</th>
                               <th class="p-0 pb-3 w-80px text-end">مشاهدة</th>
                           </tr>
                           </thead>
                           <!--end::Table head-->
                           <!--begin::Table body-->
                           <tbody>
                           @foreach($data as $post)
                               <tr>
                                   <td class="text-end pe-0">
                                       <div class="d-flex align-items-center">
                                           <div class="symbol symbol-50px ms-3">
                                               <img src="{{ asset($post->user->avatar) }}" class="" alt="">
                                           </div>
                                           <div class="d-flex justify-content-start flex-column">
                                               <a href="{{ route('users.show', $post->user) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $post->user->name }}</a>
                                               <span class="text-gray-400 fw-semibold d-block fs-7">{{ $post->user->email }}</span>
                                           </div>
                                       </div>
                                   </td>
                                   <td class="text-end pe-0">
                                      {{ $post->group->name }}
                                   </td>
                                   <td class="text-end pe-0">
                                       {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                                   </td>
                                   <td class="text-end">
                                       <a href="{{ route('groups.show', $post->group) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                           <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                       </a>
                                   </td>
                               </tr>
                           @endforeach
                           </tbody>
                           <!--end::Table body-->
                       </table>
                   </div>
                   <!--end::Table-->
               </div>
               <!--end: Card Body-->
           </div>
           <!--end::Table widget 12-->
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
