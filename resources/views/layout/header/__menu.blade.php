<!--begin::Menu wrapper-->
<div class="header-menu flex-column flex-lg-row"
     data-kt-drawer="true"
     data-kt-drawer-name="header-menu"
     data-kt-drawer-activate="{default: true, lg: false}"
     data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}"
     data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_header_menu_toggle"
     data-kt-swapper="true"
     data-kt-swapper-mode="prepend"
     data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}"
>
    <!--begin::Menu-->
    <div
        class="menu menu-rounded menu-column menu-lg-row menu-root-here-bg-desktop menu-active-bg menu-state-primary menu-title-gray-800 menu-arrow-gray-500  align-items-stretch flex-grow-1  my-5 my-lg-0 px-2 px-lg-0 fw-semibold fs-6"
        id="#kt_header_menu"
        data-kt-menu="true"
    >
        @can('viewAny', \App\Models\User::class)
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                 class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <!--begin:Menu link--><span class="menu-link py-3"><span class="menu-title">Users</span><span
                        class="menu-arrow d-lg-none"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link py-3" href="{{ route('users.index') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-profile-user fs-2">
                                 <span class="path1"></span>
                                 <span class="path2"></span>
                                 <span class="path3"></span>
                                 <span class="path4"></span>
                                </i>
                        </span><span class="menu-title">View all</span></a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link py-3" href="{{ route('users.create') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-2">
                                 <span class="path1"></span>
                                 <span class="path2"></span>
                            </i>
                        </span><span class="menu-title">Create new</span></a>
                        <!--end:Menu link-->
                    </div><!--end:Menu item-->
                </div><!--end:Menu sub-->
            </div><!--end:Menu item-->
            <!--begin:Menu item-->
        @endcan

        @can('viewAny', \App\Models\Group::class)
            <!--begin:Menu item-->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start"
                 class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                <!--begin:Menu link--><span class="menu-link py-3"><span class="menu-title">Groups</span><span
                        class="menu-arrow d-lg-none"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-250px">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link py-3" href="{{ route('groups.index') }}">
                        <span class="menu-icon">

                            <i class="ki-duotone ki-clipboard fs-2">
                             <span class="path1"></span>
                             <span class="path2"></span>
                             <span class="path3"></span>
                            </i>

                        </span>
                            <span class="menu-title">View all</span></a>
                        <!--end:Menu link-->
                        <!--begin:Menu link-->
                        <a class="menu-link py-3" href="{{ route('groups.create') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-files-tablet fs-2">
                                 <span class="path1"></span>
                                 <span class="path2"></span>
                                </i>
                           </span><span class="menu-title">Create new</span></a>
                        <!--end:Menu link-->
                    </div><!--end:Menu item-->
                </div><!--end:Menu sub-->
            </div><!--end:Menu item-->
            <!--begin:Menu item-->
        @endcan


        @if(Auth::user()->hasRole('student'))
            <a class="menu-link py-3 text-dark" href="{{ route('my-groups') }}">My Groups</a>
        @endif

    </div>
    <!--end::Menu-->

</div>
<!--end::Menu wrapper-->
