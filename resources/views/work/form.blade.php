@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new work</div>
                    <div class="panel-body">

                        @if(isset($customers))

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/work/register') }}">
                            {{ csrf_field() }}

                            <!--
                                customer Id
                                address
                                description
                                status (finished/not finished)
                                created_at
                             -->

                                <!-- CUSTOMER -->
                                <div class="form-group{{ $errors->has('customer') ? ' has-error' : '' }}">
                                    <label for="customer" class="col-md-4 control-label">Customer</label>

                                    <div class="col-md-6">
                                        <select class="form-control" name="customer_id" id="customer">
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}">
                                                    {{$customer->contact_name}}
                                                    @if(strlen($customer->company_name) > 2)
                                                        ({{$customer->company_name}})
                                                    @else
                                                        {{ ' (Private)' }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <!-- ADDRESS -->
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-4 control-label">Work Address</label>

                                    <div class="col-md-6">
                                        <textarea id="address" rows="2" type="text" class="form-control"
                                                  placeholder="Silmukkatie 21, 65100 Vaasa"
                                                  name="address" content="{{ old('address') }}">{{ old('address') }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <strong>
                                                {{-- $errors->first('address') --}}
                                                {{ Session::get('address_error_message'), function() {return 'Silmukkatie 21, 65100 vaasa';} }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <!-- DESCRIPTION -->
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-md-4 control-label">Task Description</label>

                                    <div class="col-md-6">
                                        <textarea id="description" type="text" rows="5" class="form-control"
                                                  placeholder="Task Description" name="description" >{{ old('description') }}</textarea>

                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
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
                        @else

                            <p align="center">Customer is required before getting work, so please
                                <a href="{{ url('/customer/form') }}" > Register Customer </a> before adding new work.</p>
                            <p align="center">Use the following button to add new Customers.</p>

                            <p align="center">
                                <button class="btn btn-sm btn-primary" type="button"
                                        onclick="window.location.href='/customer/form'">
                                    Register Customer </button></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
