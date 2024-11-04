<!--begin::Topbar-->
<div class="d-flex align-items-center flex-shrink-0">
    <!--begin::User-->
    <div class="d-flex align-items-center ms-3 ms-lg-4" id="kt_header_user_menu_toggle">
        <!--begin::Menu- wrapper-->
        <!--begin::User icon(remove this button to use user avatar as menu toggle)-->
        <div
            class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-active-bg-light w-30px h-30px w-lg-40px h-lg-40px
            border-gray-600"
            data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">

            <div class="symbol symbol-35px">
                <img alt="Logo" src="{{ asset(\Illuminate\Support\Facades\Auth::user()->avatar) }}"/>
            </div>

        </div>
        <!--end::User icon-->
        @include('partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User -->
    <!--begin::Sidebar Toggler-->
    <!--end::Sidebar Toggler-->
</div>
<!--end::Topbar-->
