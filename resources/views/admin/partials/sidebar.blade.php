<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        @if(Setting::get('site_logo') != null)
        <img class="app-sidebar__user-avatar" src="{{ asset('storage/'.Setting::get('site_logo')) }}" alt="User
        Image" style="width: 48px; height: auto">
        @else
        <img class="app-sidebar__user-avatar" src="https://www.placecage.com/48/48" alt="User Image">
        @endif
        <div>
            {{-- <img src="{{ asset('storage/'.Setting::get('site_logo')) }} ?: https://i.pravatar.cc/300" class="rounded-circle align-items-center--}}
            {{-- align-content-center"--}}
            {{-- style="width: 100px; height: 100px;"/>--}}
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            {{-- <p class="app-sidebar__user-designation">Frontend Developer</p>--}}
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard')
            }}"><i class="app-menu__icon fa
            fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon icon fa fa-user" aria-hidden="true"></i>
                <span class="app-menu__label">Users</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-user" aria-hidden="true"></i> Admin Users</a>
                </li>
                <li>
                    <a class="treeview-item" href="#" target="_blank" rel="noopener noreferrer"><i class="icon fa fa-user"></i> Roles</a>
                </li>
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i> Permissions</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('cities*') ? 'active' : '' }}" href="{{ route('cities.index')
            }}"><i class="app-menu__icon fa fa-building"></i>
                <span class="app-menu__label">City</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('galleries*') ? 'active' : '' }}" href="{{ route('galleries.index')
            }}">
                <i class="app-menu__icon
             fa fa-file-image-o" aria-hidden="true"></i>
                <span class="app-menu__label">Gallery</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('halls*') ? 'active' : '' }}" href="{{ route('halls.index') }}"><i class="app-menu__icon fa
            fa fa-building" aria-hidden="true""></i>
                <span class=" app-menu__label">Halls</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ request()->is('staffs*') ? 'active' : '' }}" href="{{ route('staffs.index') }}"><i class="app-menu__icon fa
            fas fa-users" aria-hidden="true""></i>
                <span class=" app-menu__label">Staffs</span>
            </a>
        </li>
        {{-- <li>--}}
        {{-- <a class="app-menu__item {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i--}} {{--                    class="app-menu__icon fa--}} {{--            fa fa-building" aria-hidden="true""></i>--}} {{--                <span class="app-menu__label">Roles</span>--}} {{--            </a>--}} {{--        </li>--}} {{--        <li>--}} {{--            <a class="app-menu__item {{ request()->is('staff-roles*') ? 'active' : '' }}" href="{{ route('staff-roles.index') }}">
            <i--}} {{--                    class="app-menu__icon fa--}} {{--            fa fa-building" aria-hidden="true""></i>--}} {{--                <span class="app-menu__label">Staff-Roles</span>--}} {{--            </a>--}} {{--        </li>--}} <li>
                <a class="app-menu__item {{ request()->is('partners*') ? 'active' : '' }}" href="{{ route('partners.index') }}"><i class="app-menu__icon fa
            fa fa-building" aria-hidden="true""></i>
                <span class=" app-menu__label">Partners</span>
                </a>
                </li>
                <li>
                    <a class="app-menu__item {{ request()->is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}"><i class="app-menu__icon fa
            fa fa-calendar" aria-hidden="true""></i>
                <span class=" app-menu__label">Events</span>
                    </a>
                </li>
                <li>
                    <a class="app-menu__item {{ request()->routeIs('eventstaffs.*') ? 'active' : '' }}" href="{{ route('eventstaffs.index') }}"><i class="app-menu__icon fa
            fa fa-calendar" aria-hidden="true""></i>
                <span class=" app-menu__label">Event-Staffs</span>
                    </a>
                </li>
                {{-- <li>--}}
                {{-- <a class="app-menu__item {{ request()->is('partner-roles*') ? 'active' : '' }}" href="{{ route('partner-roles.index') }}"><i--}} {{--                    class="app-menu__icon fa--}} {{--            fa fa-building" aria-hidden="true""></i>--}} {{--                <span class="app-menu__label">Partner Roles</span>--}} {{--            </a>--}} {{--        </li>--}} <li class="treeview">
                    <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i>
                        <span class="app-menu__label">Role Management</span>
                        <i class="treeview-indicator fa fa-angle-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        {{-- <li>--}}
                        {{-- <a class="treeview-item " href="{{ route('staffs.index') }}"><i class="app-menu__icon fa--}}
                {{--                    fa-cogs"></i>--}}
                {{--                        <span class="app-menu__label">Staffs</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li>
                    <a class=" treeview-item {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index')
                    }}"><i class="app-menu__icon fa fa-user-cog"></i>
                            <span class="app-menu__label">Roles</span>
                            </a>
                            </li>
                            <li>
                                <a class="treeview-item" href="{{ route('staff-roles.index')}}"><i class="app-menu__icon fa fa-cogs"></i>
                                    <span class="app-menu__label">Staff-Roles</span>
                                </a>
                            </li>
                            {{-- <li>--}}
                            {{-- <a class="treeview-item" href="{{ route('partners.index')}}"><i class="app-menu__icon fa--}}
                {{--                    fa-cogs"></i>--}}
                {{--                        <span class="app-menu__label">Partners</span>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li>
                    <a class=" treeview-item" href="{{ route('partner-roles.index')}}"><i class="app-menu__icon fa
                    fa-cogs"></i>
                                <span class="app-menu__label">Partner-Roles</span>
                                </a>
                                </li>
                    </ul>
                    </li> <!-- end of three view -->
                    <li>
                        <a class="app-menu__item {{ request()->is('settings*') ? 'active' : '' }}" href="{{ route('admin.settings')
            }}"><i class="app-menu__icon fa fa-cogs"></i>
                            <span class="app-menu__label">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="app-menu__item {{ request()->is('logout*') ? 'active' : '' }}" href="{{ route('logout') }}" onClick="event.preventDefault();
                document.getElementById('logout-form').submit();">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <i class="app-menu__icon fa fa-sign-out"></i>
                            <span class="app-menu__label">Logout</span>
                        </a>
                    </li>
    </ul>
</aside>
