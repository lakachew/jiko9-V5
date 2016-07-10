<?php

namespace App\Http\Controllers;

use App\Map;
use App\User;
use App\UserWork;
use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @return mixed
     */
    public function getAll()
    {
        $header = "All Employees";
        $employees = User::all();

        return view('employee')
            ->with('employees', $employees)
            ->with('header', $header);
    }

    public function getAssigned()
    {
        $header = "Assigned Employees";
        $users = User::all();


        $assignedEmployees = collect();

        foreach ($users as $user)
        {
            foreach ($user->worklogs as $worklog)
            {
                $assignedEmployees->prepend($user);
            }
        }

        $assignedEmployees = $assignedEmployees->unique();

        return view('employee')
            ->with('employees',$assignedEmployees)
            ->with('header', $header);
    }

    public function getNotAssigned()
    {
        $header = "Employees Not Assigned";
        $users = User::all();

        $assignedEmployees = collect();

        foreach ($users as $user)
        {
            foreach ($user->worklogs as $worklog)
            {
                $assignedEmployees->prepend($user);
            }
        }

        $assignedEmployees = $assignedEmployees->unique();

        $notAssignedEmployees = $users->diff($assignedEmployees);

        return view('employee')
            ->with('employees',$notAssignedEmployees)
            ->with('header', $header);
    }

    public function getActive()
    {
        $header = "Active Employees";
        $users = User::all();

        $activeEmployees = collect();

        foreach ($users as $user)
        {
            foreach ($user->worklogs as $worklog)
            {
                foreach ($worklog->maps as $map)
                {
                    if($map->start == 1)
                    {
                        $activeEmployees->prepend($user);
                        break;
                    }
                }
            }
        }

        $activeEmployees = $activeEmployees->unique();

        return view('employee')
            ->with('employees',$activeEmployees)
            ->with('header', $header);
    }

    public function getInactive()
    {
        $header = "Inactive Employees";
        $users = User::all();

        $activeEmployees = collect();
        $assignedEmployees = collect();

        foreach ($users as $user)
        {
            foreach ($user->worklogs as $worklog)
            {
                $assignedEmployees->prepend($user);
                foreach ($worklog->maps as $map)
                {
                    if($map->start == 1)
                    {
                        $activeEmployees->prepend($user);
                        break;
                    }
                }
            }
        }

        $activeEmployees = $activeEmployees->unique();
        $assignedEmployees = $assignedEmployees->unique();

        $allInActiveEmployees = $users->diff($activeEmployees);

        $notAssignedEmployees = $users->diff($assignedEmployees);

        $inActiveEmployees = $allInActiveEmployees->diff($notAssignedEmployees);

        return view('employee')
            ->with('employees',$inActiveEmployees)
            ->with('header', $header);
    }

}
