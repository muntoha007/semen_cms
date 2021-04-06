@extends('layouts.base')

@section('body')
    {{-- <div class="container-fluid">
        <div class="py-3">
            <div class="row">
                <div class="col-md-3">
                    <x-layouts.sidebar></x-layouts.sidebar>
                </div>
                <div class="col-md-9">
                    <div class="mt-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <x-layouts.sidebar></x-layouts.sidebar>
    <div class="main-content">
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                    href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                            </div>

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
        @yield('content')
    </div>
@endsection
