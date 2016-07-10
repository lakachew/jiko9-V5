@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">


                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>email</th>
                                        <th>Started Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <@foreach($employees as $employee)
                                        <tr>
                                            <label for="{{$employee->id}}">

                                                <td>{{ $employee->first_name }} {{ $employee->last_name }} </td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->getDate() }}</td>
                                            </label>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
