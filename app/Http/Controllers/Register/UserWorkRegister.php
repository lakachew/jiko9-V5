<?php
/**
 * Created by PhpStorm.
 * User: lakachew
 * Date: 01/07/2016
 * Time: 23:15
 */

namespace App\Http\Controllers\Register;


use App\Customer;
use App\User;
use App\UserWork;
use App\Work;
use Illuminate\Http\Request;

trait UserWorkRegister
{

    use RedirectsForm;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        $works = Work::all();
        $employees = User::all();
        $userWorks = UserWork::all();


        return view('work.assign')
            ->with('works', $works)
            ->with('employees', $employees)
            ->with('userWorks', $userWorks);
    }

    

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        if(isset($request->employee) && isset($request->work) )
        {

            $customerId = Work::where('id', $request->work)->first()->customer_id;
            //dd($request);
            $request->merge(['work_customer_id' => $customerId]);

            //dd($customerId);
        }

        //dd($request);


        
        $validator = $this->validator($request->all());

        //dd($request);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //redirect back to the registration page
        $this->create($request->all());
        return redirect($this->redirectPath());
    }

}