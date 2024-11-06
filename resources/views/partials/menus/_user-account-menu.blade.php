<!--begin::User account menu-->
<div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
    data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px ms-5">
                <img alt="Logo" src="{{ asset(\Illuminate\Support\Facades\Auth::user()->avatar) }}"/>
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('doctor'))
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 me-2">Doctor</span>
                        @else
                        <span class="badge badge-light-warning fw-bold fs-8 px-2 py-1 me-2">Student</span>
                    @endif

                </div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ \Illuminate\Support\Facades\Auth::user()->email }}</a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('profile.show') }}" class="menu-link px-5">
            Profile
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->

    <!--begin::Menu item-->

    <div class="menu-item px-5">
        <a href="{{ route('logout') }}" class="menu-link px-5"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
