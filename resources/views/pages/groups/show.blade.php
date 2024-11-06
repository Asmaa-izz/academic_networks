@php use Carbon\Carbon; Carbon::setLocale('ar'); @endphp
@extends('base')
@section('title', $group->name)
@section('breadcrumb-item')
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('home') }}" class="text-gray-600 text-hover-primary  ms-2">Home</a>
    </li>
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ route('groups.index') }}" class="text-gray-600 text-hover-primary  ms-2">Groups</a>
    </li>
    <li class="breadcrumb-item text-gray-500">{{ $group->name }}</li>
@endsection

@section('action')
    @can('update', $group)
        <a href="{{ route('groups.edit', $group) }}" class="btn btn-primary fw-bold ms-3">Edit</a>

        <a href="{{ route('groups.role.edit', $group) }}" class="btn btn-primary fw-bold">Edit Role</a>
    @endcan

    @if((Auth::user()->hasRole('student') && $group->users) && (!in_array(Auth::id() , $group->users->pluck('id')->toArray())))
        @if($group->groupJoin->count() > 0)
            <span class="badge badge-secondary">Waiting for approval</span>
        @else
            <form action="{{ route('group-join.store') }}" method="POST">
                @csrf
                <input type="hidden" name="group_id" value="{{ $group->id }}">
                <button type="submit" class="btn btn-light-primary">join</button>
            </form>
        @endif
    @endif

@endsection

@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Social - Feeds -->
        <div class="d-flex flex-row">
            <!--begin::Start sidebar-->
            <div class="d-lg-flex flex-column flex-lg-row-auto w-lg-325px" data-kt-drawer="true"
                 data-kt-drawer-name="start-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                 data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '250px': '300px'}"
                 data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_social_start_sidebar_toggle">
                <!--begin::User menu-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body pt-15 px-0">
                        <!--begin::Member-->
                        <div class="d-flex flex-column text-center mb-9 px-9">
                            <!--begin::Info-->
                            <div class="text-center">
                                <!--begin::Name-->
                                <p class="text-gray-800 fw-bold fs-2x">{{ $group->name }}</p>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <span class="text-muted d-block fw-semibold">
                                    By
                                    <a href="{{ route('users.show',  $group->user) }}"
                                       class="text-primary">{{ $group->user->name  }}</a>
                                </span>
                                <!--end::Position-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Member-->
                        <!--begin::Row-->
                        <div class="row px-9 mb-4">
                            <!--begin::Col-->
                            <div class="col-md-6 text-center">
                                <div class="text-gray-800 fw-bold fs-3">
                                    <span class="m-0" data-kt-countup="true"
                                          data-kt-countup-value="{{$posts->count()}}">{{$posts->count()}}</span>
                                </div>
                                <span class="text-gray-500 fs-8 d-block fw-bold">Pots</span>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 text-center">
                                <div class="text-gray-800 fw-bold fs-3">
                                    <span class="m-0" data-kt-countup="true"
                                          data-kt-countup-value="{{$group->users()->count()}}">{{$group->users()->count()}}</span></div>
                                <span class="text-gray-500 fs-8 d-block fw-bold">Member</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::User menu-->

                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Members</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        @foreach($group->users as $user)
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-5">
                                    <img src="{{ asset($user->avatar) }}" class="h-50 align-self-center" alt=""/>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('users.show', $user) }}"
                                           class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $user->name }}
                                            </a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $user->email }}</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin:Action-->
                                    @if($group->getAdmin() && ($group->getAdmin()->id === $user->id ))
                                        <span class="badge badge-light-primary">group manager</span>
                                    @else
                                        <span class="badge badge-secondary">memeber</span>
                                    @endif
                                    <!--end:Action-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            @if(!$loop->last)
                            <div class="separator separator-dashed my-4"></div>
                            @endif
                            <!--end::Separator-->
                        @endforeach
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Start sidebar-->
            <!--begin::Content-->
            <div class="w-100 flex-lg-row-fluid mx-lg-13">
                <!--begin::Mobile toolbar-->
                <div class="d-flex d-lg-none align-items-center justify-content-end mb-10">
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn btn-icon btn-active-color-primary w-30px h-30px"
                             id="kt_social_start_sidebar_toggle">
                            <i class="ki-duotone ki-profile-circle fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                        <div class="btn btn-icon btn-active-color-primary w-30px h-30px"
                             id="kt_social_end_sidebar_toggle">
                            <i class="ki-duotone ki-scroll fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </div>
                    </div>
                </div>
                <!--end::Mobile toolbar-->
                <!--begin::Main form-->
                @if($isWritePost)
                <form class="card card-flush mb-10" action="{{ route('posts.store', $group) }}" method="POST">
                    @csrf
                    <!--begin::Header-->
                    <div class="card-header justify-content-start align-items-center pt-4">
                        <!--begin::Photo-->
                        <div class="symbol symbol-45px ms-5">
                            <img src="{{ asset(Auth::user()->avatar) }}" class="" alt=""/>
                        </div>
                        <!--end::Photo-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0">
                        <!--begin::Input-->
                        <textarea class="form-control bg-transparent border-0 px-0" id="kt_social_feeds_post_input"
                                  name="text" data-kt-autosize="true" rows="1" placeholder="write...."></textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer d-flex justify-content-end pt-0">
                        <!--begin::Post action-->
                        <button type="submit" class="btn btn-sm btn-primary" id="kt_social_feeds_post_btn">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">post</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">wanting...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                        <!--end::Post action-->
                    </div>
                    <!--end::Footer-->
                </form>
                @endif
                <!--end::Main form-->
                <!--begin::Posts-->
                <div class="mb-10" id="kt_social_feeds_posts">
                    <!--begin::Post 1-->
                    @foreach($posts as $i => $post)
                        <!--begin::Card-->
                        <div class="card card-flush mb-10">
                            <!--begin::Card header-->
                            <div class="card-header pt-9">
                                <!--begin::Author-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px ms-5">
                                        <img src="{{ asset($post->user->avatar) }}" class="" alt=""/>
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Info-->
                                    <div class="flex-grow-1">
                                        <!--begin::Name-->
                                        <a href="#"
                                           class="text-gray-800 text-hover-primary fs-4 fw-bold">{{ $post->user->name }}</a>
                                        <!--end::Name-->
                                        <!--begin::Date-->
                                        <span
                                            class="text-gray-400 fw-semibold d-block">{{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                        <!--end::Date-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Author-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Post content-->
                                <div class="fs-6 fw-normal text-gray-700 mb-5">{{ $post->text }}</div>
                                <!--end::Post content-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer pt-0">
                                <!--begin::Info-->
                                <div class="mb-6">
                                    <!--begin::Separator-->
                                    <div class="separator separator-solid"></div>
                                    <!--end::Separator-->
                                    <!--begin::Nav-->
                                    <ul class="nav py-3">
                                        <!--begin::Item-->
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-gray-600 btn-active-color-primary btn-active-light-primary fw-bold px-4 ms-1 collapsible {{ $i !== 0 ?: 'active' }}"
                                               data-bs-toggle="collapse" href="#kt_social_feeds_comments_1">
                                                <i class="ki-duotone ki-message-text-2 fs-2 ms-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>{{ $post->comments_count }} تعليق </a>
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-solid mb-1"></div>
                                    <!--end::Separator-->
                                    <!--begin::Comments-->
                                    <div class="collapse {{ $i !== 0 ?: 'show' }}" id="kt_social_feeds_comments_1">
                                        @foreach($post->comments as $comment)
                                            <!--begin::Comment-->
                                            <div class="d-flex pt-6">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-45px ms-5">
                                                    <img src="{{ asset($comment->user->avatar) }}" alt=""/>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-column flex-row-fluid">
                                                    <!--begin::Info-->
                                                    <div class="d-flex align-items-center flex-wrap mb-0">
                                                        <!--begin::Name-->
                                                        <a href="#"
                                                           class="text-gray-800 text-hover-primary fw-bold ms-6">{{ $comment->user->name }}</a>
                                                        <!--end::Name-->
                                                        <!--begin::Date-->
                                                        <span
                                                            class="text-gray-400 fw-semibold fs-7 me-5">{{ Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                                                        <!--end::Date-->
                                                    </div>
                                                    <!--end::Info-->
                                                    <!--begin::Text-->
                                                    <span
                                                        class="text-gray-800 fs-7 fw-normal pt-1">{{ $comment->text }}</span>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Wrapper-->
                                            </div>
                                            <!--end::Comment-->
                                        @endforeach
                                    </div>
                                    <!--end::Collapse-->
                                </div>
                                <!--end::Info-->
                                @if($isWriteComment)
                                <!--begin::Comment form-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Author-->
                                    <div class="symbol symbol-35px me-3">
                                        <img src="{{ asset(Auth::user()->avatar) }}" alt=""/>
                                    </div>
                                    <!--end::Author-->
                                    <!--begin::Input group-->
                                    <form class="position-relative w-100" action="{{ route('comments.store', $post) }}" method="POST">
                                        @csrf
                                        <!--begin::Input-->
                                        <textarea type="text" class="form-control form-control-solid border ps-5"
                                                  rows="1" name="text" data-kt-autosize="true"
                                                  placeholder="write comment.."></textarea>
                                        <!--end::Input-->
                                        <button type="submit" class="btn btn-secondary btn-sm fs-8 ms-3 p-1 position-absolute start-0 top-0 top-25">comment</button>
                                    </form>
                                    <!--end::Input group-->
                                </div>
                                @endif
                                <!--end::Comment form-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    @endforeach
                    <!--end::Post 1-->
                </div>
                <!--end::Posts-->
            </div>
            <!--end::Content-->
            <!--begin::End sidebar-->
            <div class="d-lg-flex flex-column flex-lg-row-auto w-lg-325px" data-kt-drawer="true"
                 data-kt-drawer-name="end-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                 data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '250px': '300px'}"
                 data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_social_end_sidebar_toggle">
                <!--begin::Social widget 1-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">The most activity members</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        @foreach($topUsers as $user)
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40px me-5">
                                    <img src="{{ asset($user->avatar) }}" class="h-50 align-self-center" alt=""/>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <!--begin:Author-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{ route('users.show', $user) }}"
                                           class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $user->name }}
                                        </a>
                                        <span class="text-muted fw-semibold d-block fs-7">{{ $user->email }}</span>
                                    </div>
                                    <!--end:Author-->
                                    <!--begin:Action-->
                                    <p class="btn btn-sm btn-light fs-8 fw-bold">{{ $user->posts_count }}</p>
                                    <!--end:Action-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            @if(!$loop->last)
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->
                            @endif
                        @endforeach
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Social widget 1-->
            </div>
            <!--end::End sidebar-->
        </div>
        <!--end::Social - Feeds-->
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
@endsection
