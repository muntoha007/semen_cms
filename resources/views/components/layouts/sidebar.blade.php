{{-- <div>
    @foreach ($navigations as $navigation)
        @can($navigation->permission_name)
            <div class="mb-4">
                <small class="d-block text-secondary mb-2 text-uppercase"> <strong>{{ $navigation->name }}</strong> </small>
                <div class="list-group">
                    @foreach ($navigation->children as $child)
                        <a href="{{ url($child->url) }}" class="list-group-item list-group-item-action">{{ $child->name }}</a>
                    @endforeach
                </div>
            </div>
        @endcan
    @endforeach


    <div class="mb-4">
        <small class="d-block text-secondary mb-2 text-uppercase">Logout</small>
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div> --}}

{{-- menu side bar --}}
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('assets') }}/img/brand/logo-perapera-blue.jpg" class="navbar-brand-img" alt="..."
                style="max-height: 4.5rem;">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    {{-- <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a> --}}
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets') }}/img/brand/logo-perapera-blue.jpg">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
@can('create role')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-master" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-master">
                        <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                        <span class="nav-link-text">Master</span>
                    </a>

                    <div class="collapse" id="navbar-master">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('users.index') }}">
                                    Users
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('roles.index') }}">
                                    Roles
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('permissions.index') }}">
                                    Permissions
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('assign.create') }}">
                                    Assign
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('assign.user.create') }}">
                                    Assign User
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#room1" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="room1">
                        <i class="ni ni-archive-2" style=""></i>
                        <span class="nav-link-text">Room 1</span>
                    </a>

                    <div class="collapse" id="room1">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('letters.categories.index') }}">
                                    Letter Categories
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('letters.letters.index') }}">
                                    Letter
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('letters.courses.index') }}">
                                    Letter Course
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('letters.questions.index') }}">
                                    Question
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#room2" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="room2">
                        <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                        <span class="nav-link-text">Room 2</span>
                    </a>

                    <div class="collapse" id="room2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('verbs.levels.index') }}">
                                    Verb Level
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('verbs.groups.index') }}">
                                    Verb Groups
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('verbs.words.index') }}">
                                    Verb Words
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#room3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="room3">
                        <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                        <span class="nav-link-text">Room 3</span>
                    </a>

                    <div class="collapse" id="room3">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    User3
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#room4" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="room4">
                        <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                        <span class="nav-link-text">Room 4</span>
                    </a>

                    <div class="collapse" id="room4">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    User
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#room5" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="room5">
                        <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                        <span class="nav-link-text">Room 5</span>
                    </a>

                    <div class="collapse" id="room5">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link" href="#">
                                    User
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                @foreach ($navigations as $key => $navigation)
                    @can($navigation->permission_name)
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#navbar-examples{{ $key }}" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="navbar-examples">
                                <i class="ni ni-archive-2" style="color: #5d1eb1;"></i>
                                <span class="nav-link-text">{{ $navigation->name }}</span>
                            </a>

                            <div class="collapse" id="navbar-examples{{ $key }}">
                                <ul class="nav nav-sm flex-column">
                                    @foreach ($navigation->children as $child)
                                        <li class="nav-item ">
                                            <a class="nav-link" href="{{ url($child->url) }}">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endforeach
            </ul>
        </div>
    </div>
</nav>
