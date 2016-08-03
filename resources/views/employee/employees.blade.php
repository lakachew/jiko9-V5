@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">
                        <div class="col-md-6">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>

                                </tr>
                                </thead>
                                <tbody>

                                @php($counter = 0)

                                @foreach($employees as $employee)
                                    @php($counter++)
                                    @if($counter % 2 != 0)
                                        <tr>
                                            <label for="{{$employee->id}}">
                                                <td> <a href="/employee/{{$employee->id}}">{{ $employee->first_name }} {{ $employee->last_name }} </a> </td>
                                                <td>{{ $employee->phone }}</td>
                                            </label>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php($counter = 0)
                                @foreach($employees as $employee)
                                    @php($counter++)
                                    @if($counter % 2 == 0)
                                        <tr>
                                            <label for="{{$employee->id}}">
                                                <td><a href="/employee/{{$employee->id}}">{{ $employee->first_name }} {{ $employee->last_name }} </a></td>
                                                <td>{{ $employee->phone }}</td>
                                            </label>
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
