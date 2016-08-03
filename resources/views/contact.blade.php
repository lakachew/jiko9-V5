@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body ">
                        @php($counter = 0)
                        <div class=" col-md-6">
                            @foreach($employees as $employee)
                                @php($counter++)
                                @if($counter % 2 != 0)
                                    <h3 style="margin-left: 15px;">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td><i class="glyphicon glyphicon-user"></i> Role</td>
                                            <td>{{ $employee->privilege }}</td>
                                        </tr>
                                        <tr>
                                            <td> <i class="glyphicon glyphicon-phone"></i> Phone</td>
                                            <td>{{ $employee->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td ><i class="glyphicon glyphicon-envelope"></i> Email</td>
                                            <td>{{ $employee->email }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            @endforeach
                        </div>

                        <div class=" col-md-6">
                            @php($counter = 0)
                            @foreach($employees as $employee)
                                @php($counter++)
                                @if($counter % 2 == 0)
                                    <h3 style="margin-left: 15px;">{{ $employee->first_name }} {{ $employee->last_name }}</h3>
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td><i class="glyphicon glyphicon-user"></i> Role</td>
                                            <td>{{ $employee->privilege }}</td>
                                        </tr>
                                        <tr>
                                            <td> <i class="glyphicon glyphicon-phone"></i> Phone</td>
                                            <td>{{ $employee->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td ><i class="glyphicon glyphicon-envelope"></i> Email</td>
                                            <td>{{ $employee->email }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endif
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
