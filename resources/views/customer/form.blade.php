@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new customer</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/register') }}">
                        {{ csrf_field() }}

                        <!-- COMPANY NAME -->
                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <label for="company_name" class="col-md-4 control-label">Company Name</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}">

                                    @if ($errors->has('company_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- CONTACT NAME -->
                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="contact_name" class="col-md-4 control-label">Contact Name</label>

                                <div class="col-md-6">
                                    <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}">

                                    @if ($errors->has('contact_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- E-MAIL -->
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- PHONE -->
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-4 control-label">Phone No</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <!-- ADDRESS -->
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
