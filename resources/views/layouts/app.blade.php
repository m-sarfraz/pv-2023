<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/image/global/favicon.png')  }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')  }}" />
    <link rel="stylesheet" href="{{ asset('assets/custom_css/global.css') }}">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('style')


</head>
<body>
<div>
    <!--loader-->
    <div id="loader" style="display: none;" ></div>

    <div class="w-100 px-3">
<body>  <div>
    <div class="w-100 px-3 d-none">
        <i class="fa fa-bars menu-block" aria-hidden="true"></i>
    </div>
    <nav id="asad" style="background: #dc8627;">
        <div class="nav nav-tabs nav_Tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" style="cursor: pointer;">
                Dashboard
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                Data Entry
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                JDL
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                View Records
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                Finance
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                Logs
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                domains
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                Smart Search
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                dropdowns
            </a>
            <a class="nav-link nav_Link" style="cursor: pointer;">
                Teams
            </a>
            <div class="">
                <div class="dropdown pt-2 pl-2 text-white">
                    Clients Profile
                    <i class="fa fa-chevron-down ml-2 mt-2" style="color: white;"></i>
                    <div class="dropdown-content" style="left: -76px;">
                        <a href="#">
                            Companies
                        </a>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="dropdown pt-2 pl-2 text-white">
                    Users Management
                    <i class="fa fa-chevron-down ml-2 mt-2" style="color: white;"></i>
                    <div class="dropdown-content" style="left: 14px;">
                        <a href="#">
                            Users
                        </a>
                        <a href="#">
                            Add User
                        </a>
                    </div>
                </div>
            </div>
            <div class="ml-auto E_S_icon pr-8">
                <div class="d-flex pl-3 pr-2" style="border: 1px solid #dc8627; background: #fff; height: 37px; border-radius: 33px;">
                    <div class="pt-0">
                        <input type="text" placeholder="search here" class="border-0 pl-3 rounded" name="" id="" />
                        <button class="border-0 outline-0 rounded mt-1">
                            search
                        </button>
                    </div>
                    <div></div>
                </div>
                <h4 class="px-2 pt-1 text-white border-right" style="font-size: 22px;">
                    Eallaine System
                </h4>
                <div class="dropdown px-3">
                    <img class="mb-1 dropbtn" src="{{asset('assets/image/global/header-profile.png')}}" alt="" />
                    <i class="fa fa-chevron-down mt-2" style="color: white;"></i>
                    <div class="dropdown-content">
                        <a href="/editprofile">
                            <a href="#">Edit Profile</a>
                        </a>
                        <a href="" class="text-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="logoutMobile">
            <a href="" class="text-white">Logout</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane"><div>Dashboard main</div></div>
        <div class="tab-pane"><div>Data_Entry</div></div>
        <div class="tab-pane"><div>JDL</div></div>
        <div class="tab-pane"><div>VIEWRECORDS</div></div>
        <div class="tab-pane"><div>VIEWFINANCE</div></div>
        <div class="tab-pane"><div>LOGS</div></div>
        <div class="tab-pane"><div>AdminDomain</div></div>
        <div class="tab-pane"><div>SMARTSEARCH</div></div>
        <div class="tab-pane"><div>AdminDropdowns</div></div>
        <div class="tab-pane"><div>Team</div></div>

    </div>
</div>
        <div>
                @yield('content')
        </div>

        <script src="{{ asset('assets/plugins/bootstrap/script/jquery.min.js') }}"></script>
        <!-- sweet alert cdn-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @yield('script')
</body>
</html>
