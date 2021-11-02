<div>

    <?php
    $routeName = Route::currentRouteName();
    ?>
    <div class="w-100 px-3 menu-blockDiv">
        <i class="bi bi-list menu-block" onclick="myFunction()" aria-hidden="true"></i>
    </div>
    <nav id="navBarSmall" class="navBarSmallClass" style="background: #dc8627;">
        <div class="nav nav-tabs nav_Tabs" id="nav-tab" role="tablist">
            <a class="nav-link {{ $routeName == 'home' ? 'nav-active' : 'text-white' }}" href="{{ route('home') }}"
                style="cursor: pointer;">
                Dashboard
            </a>
            <a href="{{ route('data-entry') }}"
                class="nav-link {{ $routeName == 'data-entry' ? 'nav-active' : 'text-white' }}"
                style="cursor: pointer;">
                Data Entry
            </a>
            @can('view-jdl')
                <a href="{{ route('jdl') }}" class="nav-link  {{ $routeName == 'jdl' ? 'nav-active' : 'text-white' }}"
                    style="cursor: pointer;">
                    JDL
                </a>
            @endcan
            @can('view-record')
                <a class="nav-link {{ $routeName == 'record' ? 'nav-active' : 'text-white' }} "
                    href="{{ route('record') }}" style="cursor: pointer;">
                    View Records
                </a>
            @endcan
            @can('view-finance')
                <a class="nav-link {{ $routeName == 'finance' ? 'nav-active' : 'text-white' }} "
                    href="{{ route('finance') }}" style="cursor: pointer;">
                    Finance
                @endcan
            </a>
            @can('view-logs')
                <a class="nav-link {{ $routeName == 'log' ? 'nav-active' : 'text-white' }}" href="{{ route('log') }}"
                    style="cursor: pointer;">
                    Logs
                </a>

            @endcan
            @can('view-domain-list')
                <a class="nav-link {{ $routeName == 'domain' ? 'nav-active' : 'text-white' }}"
                    href="{{ route('domain') }}" style="cursor: pointer;">
                    Domains
                </a>
            @endcan
            @can('view-smart-search')

                <a class="nav-link {{ $routeName == 'search' ? 'nav-active' : 'text-white' }}"
                    href="{{ route('search') }}" style="cursor: pointer;">
                    Smart Search
                </a>
            @endcan
            @can('view-dropdowns')
            <div class="dropdown pt-2 pl-2 text-white">
                Dropdowns
                <i class="bi bi-chevron-down ml-2 mt-2" style="color: white;"></i>
                <div class="dropdown-content" style="left: 14px;">
                    <a href="{{ route('dropdown') }}">
                        Add Dropdowns
                    </a>

                </div>
            </div>
            @endcan
            @can('view-team')
            <a href="{{ route('role.index') }}"
                class="nav-link {{ $routeName == 'role.index' ? 'nav-active' : 'text-white' }}"
                style="cursor: pointer;">
                Teams
            </a>
            @endcan
            @can('view-company')
            <div class="">
                <div class="dropdown pt-2 pl-2 text-white">
                    Clients Profile
                    <i class="bi bi-chevron-down ml-2 mt-2" style="color: white;"></i>
                    <div class="dropdown-content" style="left: -76px;">
                        <a href="{{ route('companies') }}">
                            Companies
                        </a>
                    </div>
                </div>
            </div>
            @endcan
           
            @can('view-users')
            <div class="dropdown pt-2 pl-2 text-white">
                Users Management
                <i class="bi bi-chevron-down ml-2 mt-2" style="color: white;"></i>
                <div class="dropdown-content" style="left: 14px;">
                    <a href="{{ route('user.index') }}">
                        Users
                    </a>

                </div>
            </div>
            @endcan
            <div class="ml-auto E_S_icon pr-8">
                {{-- <div class="d-flex pl-3 pr-2" style="border: 1px solid #dc8627; background: #fff; height: 37px; border-radius: 33px;">
                            <div class="pt-0">
                                <input type="text" placeholder="search here" class="border-0 pl-3 rounded" name="" id="" />
                                <button class="border-0 outline-0 rounded mt-1">
                                    search
                                </button>
                            </div>
                            <div></div>
                        </div> --}}
                <h4 class="px-2 pt-1 text-white border-right" style="font-size: 22px;">
                    Eallaine System
                </h4>
                <div class="dropdown px-3">
                    <img class="mb-1 dropbtn" src="{{ asset('assets/image/global/header-profile.png') }}" alt="" />
                    <i class="bi bi-chevron-down mt-2" style="color: white;"></i>
                    <div class="dropdown-content">
                        {{-- @can('view-profile') --}}
                        <a href="{{ route('profile') }}">
                            Edit Profile
                        </a>
                        {{-- @endcan --}}
                        <a href="{{ route('logout') }}" class="text-danger"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            Logout
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="logoutMobile">
            <a href="" class="text-white">Logout</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane">
            <div>Dashboard main</div>
        </div>
        <div class="tab-pane">
            <div>Data_Entry</div>
        </div>
        <div class="tab-pane">
            <div>JDL</div>
        </div>
        <div class="tab-pane">
            <div>VIEWRECORDS</div>
        </div>
        <div class="tab-pane">
            <div>VIEWFINANCE</div>
        </div>
        <div class="tab-pane">
            <div>LOGS</div>
        </div>
        <div class="tab-pane">
            <div>AdminDomain</div>
        </div>
        <div class="tab-pane">
            <div>SMARTSEARCH</div>
        </div>
        <div class="tab-pane">
            <div>AdminDropdowns</div>
        </div>
        <div class="tab-pane">
            <div>Team</div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script>
    // $(window).resize(function() {
    //   var $theWindowSize = $(this).width();
    if (window.innerWidth < 700) {
        $('#navBarSmall').css({
            "margin-left": "-1000px"
        });
    } else {
        $('#navBarSmall').css({
            "margin-left": "0px"
        });
    }
    // });
    function myFunction() {
        if (document.getElementById("navBarSmall").style.marginLeft == '-1000px') {
            document.getElementById("navBarSmall").style.marginLeft = '0px';
        } else {
            document.getElementById("navBarSmall").style.marginLeft = '-1000px'
        }
    }
</script>
