@extends('layouts.app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Assign Work to Employee</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/work/assign') }}">
                        {{ csrf_field() }}

                            <!-- WORKS DROPDOWN LISTS -->
                            <div  class="form-group col-md-5 {{ $errors->has('work') ? ' has-error' : '' }} ">

                                <label for="work" class="col-md-7 control-label">Work</label>
                                <div class="col-md-12">
                                    <select class="form-control" name="work" id="work" onchange="displayAssignedEmployees(this.value);">

                                        @if(isset($_GET['selected_work']))

                                            @foreach($works as $work)
                                                @if($work->id == $_GET['selected_work'])
                                                    <option selected value={!! $_GET['selected_work'] !!} >{{$work->getCustomerName()}}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option selected disabled>Choose One</option>
                                        @endif

                                        @foreach($works as $work)
                                            <option name="work_id" id="work_id" value="{{$work->id}}" >
                                                {{$work->getCustomerName()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('work'))
                                        <span class="help-block">
                                        <strong>
                                            {{ $errors->first('work') }}
                                        </strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <!-- Arrow -->
                            <div class="col-md-2">

                                <label for="employee"  class="col-md-12 control-label"><br/>--------></label>
                            </div>

                            <!-- Employee DROPDOWN LISTS -->
                            <div  class="form-group col-md-5 {{ $errors->has('employee') ? ' has-error' : '' }} ">

                                <label for="employee" class="col-md-7 control-label">Employee</label>
                                <div class="col-md-12">
                                    <select  class="form-control" name="employee" id="employee">
                                        <option selected disabled>
                                            Choose one ...
                                        </option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}" onchange="displayAssignedEmployees( {{$employee->id}})">
                                                {{$employee->first_name}}  {{$employee->last_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('employee'))
                                        <span class="help-block">
                                        <strong>
                                            {{ $errors->first('employee') }}
                                            {{-- Session::get('address_error_message'), function() {return 'Silmukkatie 21, 65100 vaasa';} --}}
                                        </strong>
                                    </span>
                                    @endif
                                </div>

                            </div>


                            <div style="padding-top: 1em" class="form-group col-md-12">
                                <div class="col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Assign
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div id="AssignedWorksTag" class="col-md-12">

                            @if (!empty($_GET["selected_work"]))
                                <div class="col-md-5">

                                    <h3 align="center" style="color: #204d74">Work Discription</h3>



                                    @foreach($works as $work)
                                        @if($work->id == $_GET["selected_work"])
                                            <?php
                                                $selectedWork = $work;
                                            ?>
                                            @break
                                        @endif
                                    @endforeach

                                    <h5>Contact name <small style="margin-left: 1em"> {{ $selectedWork->getCustomerName() }}</small></h5>
                                    <h5 >Company name <small style="margin-left: 1em"> {{ $selectedWork->getCustomerCompanyName() }}</small></h5>
                                    <h5 >phone <small style="margin-left: 1em"> {{ $selectedWork->getCustomerPhone() }}</small></h5>
                                    <h5 >email <small style="margin-left: 1em"> {{ $selectedWork->getCustomerEmail() }}</small></h5>
                                    <h5 >Work Address <small style="margin-left: 1em"> {{ $selectedWork->address }}</small></h5>
                                    <h5 >Work Status <small style="margin-left: 1em"> {{ $selectedWork->finished }}</small></h5>
                                    <h5 >Given Date <small style="margin-left: 1em"> {{ $selectedWork->created_at }}</small></h5>

                                </div>

                                <div class="col-md-7">
                                    <h3  align="center" style="color: #204d74">Assigned Employees</h3>

                                    @if(isset($userWorks))

                                            <table class="table table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>email</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($userWorks as $userWork)
                                                    @if($selectedWork->id == $userWork->work_id)
                                                        @foreach($employees as $employee)
                                                            @if($employee->id == $userWork->user_id)
                                                                <tr>
                                                                    <label for="{{$employee->id}}">

                                                                        <td>{{ $employee->first_name }} {{ $employee->last_name }} </td>
                                                                        <td>{{ $employee->phone }}</td>
                                                                        <td>{{ $employee->email }}</td>
                                                                    </label>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                                </tbody>
                                            </table>
                                        @else
                                            <p>Non Employees have been assigned</p>
                                        @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function displayAssignedEmployees(workId)
        {
            document.location = "/work/assign?selected_work=" + workId;
        }
    </script>
@endsection
