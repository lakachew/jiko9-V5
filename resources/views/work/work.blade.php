@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">


                        <div class="col-md-6">
                            <h4> <small style="margin-right: 1em">Contact name  </small> {{ $work->getCustomerName() }}</h4>
                            <h4> <small style="margin-right: 1em">Company name </small> {{ $work->getCustomerCompanyName() }}</h4>
                            <h4> <small style="margin-right: 1em">phone </small> {{ $work->getCustomerPhone() }}</h4>
                            <h4> <small style="margin-right: 1em">email </small> {{ $work->getCustomerEmail() }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h4 ><small style="margin-right: 1em">Work Address </small> {{ $work->address }}</h4>
                            <h4 ><small style="margin-right: 1em">Work Status </small>
                                @php($workStatus = $work->finished)
                                @if($workStatus == 0)
                                    Not Completed
                                @else
                                    Completed
                                @endif

                            </h4>
                            <h4 ><small style="margin-right: 1em">Requested Date </small>{{ $work->getDate() }}</h4>

                        </div>
                        <div class="col-md-6" style="height: 500px; width: 100%; border:0;">{!! Mapper::render () !!}</div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
