@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">

                        <div style="height: 500px; width: 100%; border:0;">{!! Mapper::render () !!}</div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <@foreach($works as $work)
                                <tr>
                                    <td>{{ $work->getCustomerName() }}</td>
                                    <td>{{ $work->address }}</td>
                                    <td>{{ $work->description }}</td>
                                    <td>{{ $work->getDate() }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
