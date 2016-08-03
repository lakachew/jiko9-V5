@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">

                        <div class="col-md-12" style="height: 500px; width: 100%; border:0;">{!! Mapper::render () !!}</div>

                        @php($counter = 0)
                        <div class=" col-md-6">

                            <table class="table table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($works as $work)
                                    @php($counter++)
                                    @if($counter % 2 != 0)
                                        <tr>
                                            <td><a href="/work/{{ $work->id }}"> {{ $work->getCustomerName() }}</a></td>
                                            <td>{{ $work->address }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @php($counter = 0)
                        <div class=" col-md-6">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($works as $work)
                                    @php($counter++)
                                    @if($counter % 2 == 0)
                                        <tr>
                                            <td><a href="/work/{{ $work->id }}"> {{ $work->getCustomerName() }}</a></td>
                                            <td>{{ $work->address }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
