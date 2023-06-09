
<div>
            <div class="w-100 px-3 d-none">
                <i class="fa fa-bars menu-block" aria-hidden="true"></i>
            </div>
            <nav id="navBarSmall" style="background: #dc8627;">
                <div class="nav nav-tabs nav_Tabs" id="nav-tab" role="tablist">
                    <a class="nav-link {{ Request::is('home') ? 'active' : 'text-white'  }}" href="{{ route('home')  }}" style="cursor: pointer;">
                        Dashboard
                    </a>
                    <a href="{{ route('data-entry')  }}" class="nav-link nav_Link" style="cursor: pointer;">
                        Data Entry
                    </a>
                    <a href="{{ route('jdl')  }}" class="nav-link nav_Link {{ Request::is('jdl') ? 'active' : 'text-white'  }}" style="cursor: pointer;">
                        JDL
                    </a>
                    <a class="nav-link nav_Link {{ Request::is('record') ? 'active' : 'text-white'  }}" href="{{ route('record') }}" style="cursor: pointer;">
                        View Records
                    </a>
                    <a class="nav-link nav_Link {{ Request::is('finance') ? 'active' : 'text-white'  }}" href="{{ route('finance') }}" style="cursor: pointer;">
                        Finance
                    </a>
                    <a class="nav-link nav_Link {{ Request::is('log') ? 'active' : 'text-white'  }}" href="{{ route('log') }}" style="cursor: pointer;">
                        Logs
                    </a>
                    <a class="nav-link nav_Link {{ Request::is('domain') ? 'active' : 'text-white'  }}" href="{{ route('domain') }}" style="cursor: pointer;">
                        domains
                    </a>
                    <a class="nav-link nav_Link {{ Request::is('search') ? 'active' : 'text-white'  }}" href="{{ route('search') }}" style="cursor: pointer;">
                        Smart Search
                    </a>
                    <a href="{{ route('dropdown') }}" class="nav-link nav_Link {{ Request::is('dropdown') ? 'active' : 'text-white'  }}" style="cursor: pointer;">
                        dropdowns
                    </a>
                    @can('role-list')
                    <a href="{{ route('role.index')  }}" class="nav-link nav_Link {{ Request::is('role.index') ? 'active' : 'text-white'  }}" style="cursor: pointer;">
                        Teams
                    </a>
                    @endcan
                    <div class="">
                        <div class="dropdown pt-2 pl-2 text-white">
                            Clients Profile
                            <i class="bi bi-chevron-down ml-2 mt-2" style="color: white;"></i>
                            <div class="dropdown-content" style="left: -76px;">
                                <a href="{{route('companies')}}">
                                    Companies
                                </a>
                            </div>
                        </div>
                    </div>
                    @can('user-list')
                        <div class="dropdown pt-2 pl-2 text-white">
                            Users Management
                            <i class="bi bi-chevron-down ml-2 mt-2" style="color: white;"></i>
                            <div class="dropdown-content" style="left: 14px;">
                                <a href="{{ route('user.index')  }}">
                                    Users
                                </a>

                            </div>
                        </div>
                    @endcan
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
                            <i class="bi bi-chevron-down mt-2" style="color: white;"></i>
                            <div class="dropdown-content">
                                @can('view-profile')
                                <a href="{{ route('profile')  }}">
                                    Edit Profile
                                </a>
                                @endcan
                                <a href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
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




