<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Register\CustomerRegister;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    use CustomerRegister;

    protected $redirectTo = '/customer/form';

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomerForm()
    {
        return $this->showRegistrationForm();
    }

    public function showAll()
    {
        $header = "All Customers";

        $customers = Customer::all();


        return view('customer.customers')
            ->with('customers', $customers)
            ->with('header', $header);
    }
    

    public function addNew(Request $request)
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
            'company_name' => 'max:50',
            'contact_name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:customers',
            'phone' => 'max:20',
            'address' => 'max:255',
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
        return Customer::create([
            'company_name' => $data['company_name'],
            'contact_name' => $data['contact_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
    }

}
