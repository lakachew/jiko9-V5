@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $header }}</div>

                    <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>email</th>
                                <th>Started Date</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer->company_name }} </td>
                                    <td>{{ $customer->contact_name }} </td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->getDate() }}</td>
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
