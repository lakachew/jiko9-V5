<?php
/**
 * Created by PhpStorm.
 * User: lakachew
 * Date: 04/07/2016
 * Time: 17:01
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Register\UserWorkRegister;
use App\UserWork;
use Illuminate\Http\Request;
use Validator;


class UserWorkController extends Controller
{

    use UserWorkRegister;

    protected $redirectTo = '/work/assign';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getAssignForm()
    {
        return $this->showRegistrationForm();
    }

    public function assign(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'employee' => 'required|integer',
            'work' => 'required|integer',
            'work_customer_id' => 'required|integer',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return UserWork::create([
            'user_id' => $data['employee'],
            'work_id' => $data['work'],
            'work_customer_id' => $data['work_customer_id'],
        ]);
    }
}