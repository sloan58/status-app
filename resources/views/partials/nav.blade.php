<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IED-Status</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ (Request::is('/') ? 'active' : '') }}">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                </li>
                @if(\Auth::user())
                    <li class="dropdown {{ (Request::is('projects') ? 'active' : '') }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-cogs"></i> Projects <i
                                    class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="/projects/mine"><i class="fa fa-user"></i> My Projects </a>
                            </li>
                            <li>
                                <a href="/projects"><i class="fa fa-users"></i> All Projects </a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::user()->hasRole('reporting'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-file-word-o"></i> Reporting <i
                                        class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="/reports/projects?period=1"><i class="fa fa-envelope-o"></i> Weekly Report </a>
                                </li>
                                {{--<li>--}}
                                    {{--<a href="/reports/projects?period=4"><i class="fa fa-tachometer"></i> Monthly </a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="/reports/projects?period=52"><i class="fa fa-tachometer"></i> Yearly </a>--}}
                                {{--</li>--}}
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="/auth/login"><i
                                    class="fa fa-sign-in"></i> Login</a></li>
                    {{--<li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a--}}
                                {{--href="/auth/register">Register</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <i
                                    class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::check())
                                @if(Auth::user()->hasRole('admin'))
                                    <li>
                                        <a href="/admin/dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
                                    </li>
                                <li role="presentation" class="divider"></li>
                                @endif
                            @endif
                            <li>
                                <a href="/auth/logout"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>