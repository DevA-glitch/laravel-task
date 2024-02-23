<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                @if ($footerContent && $footerContent->logo)
                    <img src="{{ url('assets/application/logo/' . $footerContent->logo) }}" alt="" height="40">
                @else
                    No Image
                @endif
            </span>
            <span class="logo-lg">
                @if ($footerContent && $footerContent->logo)
                    <img src="{{ url('assets/application/logo/' . $footerContent->logo) }}" alt=""
                        height="40">
                @else
                    No Image
                @endif
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                @if ($footerContent && $footerContent->logo)
                    <img src="{{ url('assets/application/logo/' . $footerContent->logo) }}" alt=""
                        height="40">
                @else
                    No Image
                @endif
            </span>
            <span class="logo-lg">
                @if ($footerContent && $footerContent->logo)
                    <img src="{{ url('assets/application/logo/' . $footerContent->logo) }}" alt=""
                        height="80" width="100" class="mt-2">
                @else
                    No Image
                @endif
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'dashboard') active @endif"
                        href="{{ route('dashboard') }}">
                        <div class="text-dark d-flex justify-content-center align-content-center">
                            <div>
                                <i class="ri-dashboard-2-line"></i>
                            </div>
                            <div class="mt-1">
                                <span class="fw-bold">Dashboard</span>
                            </div>
                        </div>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Route::currentRouteName() == 'index') active @endif"
                        href="{{ route('index') }}">
                        <div class="text-dark d-flex justify-content-center align-content-center">
                            <div>
                                <i class="ri-dashboard-2-line"></i>
                            </div>
                            <div class="mt-1">
                                <span class="fw-bold">Student</span>
                            </div>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
