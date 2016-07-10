<!DOCTYPE html>
<html lang="en">

<?php header("Access-Control-Allow-Origin: *");?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Jiko Oy</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->

            <!-- Branding Image -->
            @if(Auth::guest())
                <a class="navbar-brand" href="{{ url('/') }}">
                    Jiko Oy
                </a>
            @else
                <a class="navbar-brand" href="{{ url('/work/unfinished') }}">
                    Jiko Oy
                </a>
            @endif
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @if(!Auth::guest())
                <ul class="nav navbar-nav">
                    <!-- NEW DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Add <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/work/form') }}"></i>New Work</a></li>
                            <li><a href="{{ url('/customer/form') }}"></i>New Customer</a></li>
                            <li><a href="{{ url('/register') }}"></i>New Employee</a></li>
                        </ul>
                    </li>
                    <!-- WORK DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Works <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('work/all') }}"></i>All</a></li>
                            <li><a href="{{ url('work/unfinished') }}"></i>Unfinished</a></li>
                            <li><a href="{{ url('work/finished') }}"></i>Finished</a></li>
                            <li><a href="{{ url('work/form') }}"></i>Add new Work</a></li>
                            <li><a href="{{ url('work/assign') }}"></i>Assign Work</a></li>
                        </ul>
                    </li>

                    <!-- EMPLOYEE DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Employee <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('employee/all') }}"></i>All</a></li>
                            <li><a href="{{ url('employee/active') }}"></i>Active</a></li>
                            <li><a href="{{ url('employee/inactive') }}"></i>Inactive</a></li>
                            <li><a href="{{ url('employee/assigned') }}"></i>Assigned</a></li>
                            <li><a href="{{ url('employee/not_assigned') }}"></i>Not Assigned</a></li>
                            <li><a href="{{ url('/register') }}"></i>Add new employee</a></li>
                        </ul>
                    </li>

                    <!-- CUSTOMER DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Customer <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('customer/all') }}"></i>All</a></li>
                            <li><a href="{{ url('customer/form') }}"></i>Add new customer</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/contact') }}">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
