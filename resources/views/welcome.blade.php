@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Jiko Oy Web Application</div>

                    <div class="panel-body">
                        <p align="center">This site is only for registered users so please
                            <a href="{{ url('/login') }}" > Login </a> to access the site.</p>
                        <p align="center">Use the following button to go to public site.</p>

                        <p align="center"><button class="btn btn-sm btn-primary" type="button"  onclick="window.location.href='http://www.jiko.fi/'">
                                www.Jiko.fi </button></p>

                        <p align="center">For <a href="{{ url('/contact') }}" > contacting us </a> please use contact us link on top of this page.</p>
                        <p align="center">Thank you for visiting us!!! </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
