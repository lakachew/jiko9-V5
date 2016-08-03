<?php

namespace App\Http\Controllers;

use App\Map;
use App\User;
use App\UserWork;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

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


    public function contact()
    {
        $header = "Contacts";
        $employees = User::where('privilege', 'admin')->get();

        $size = $employees->count();
        $half = floor($size/2);

        return view('contact')
            ->with('employees', $employees)
            ->with('header', $header)
            ->with('size', $half);
    }
    
    /**
     * @return mixed
     */
    public function getById($idValue)
    {
        $header = "Selected Employee";
        $employee = User::find($idValue);
        //$employees = User::where('id', $idValue)->get();
        //dd($employee);



        return view('employee/employee')
            ->with('employee', $employee)
            ->with('header', $header);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $header = "All Employees";
        $employees = User::all();

        $size = $employees->count();

        $half = $size/2;


        return view('employee/employees')
            ->with('employees', $employees)
            ->with('header', $header)
            ->with('size', $half);
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

        // counting the assigned employees and assigning
        // the half value to be sent for the view
        $size = $assignedEmployees->count();
        $half = $size/2;

        return view('employee/employees')
            ->with('employees',$assignedEmployees)
            ->with('header', $header)
            ->with('size', $half);
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

        $size = $notAssignedEmployees->count();
        $half = $size/2;

        return view('employee/employees')
            ->with('employees',$notAssignedEmployees)
            ->with('header', $header)
            ->with('size', $half);
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

        $size = $activeEmployees->count();
        $half = $size/2;

        return view('employee/employees')
            ->with('employees',$activeEmployees)
            ->with('header', $header)
            ->with('size', $half);
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

        $size = $inActiveEmployees->count();
        $half = $size/2;

        return view('employee/employees')
            ->with('employees',$inActiveEmployees)
            ->with('header', $header)
            ->with('size', $half);
    }

}
