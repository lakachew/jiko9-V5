<?php
/**
 * Created by PhpStorm.
 * User: lakachew
 * Date: 29/06/2016
 * Time: 19:57
 */

namespace App\Http\Controllers\Register;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait CustomerRegister
{
    use RedirectsForm;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomerForm()
    {
        return $this->showRegistrationForm();
    }

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

        return view('customer.form');
    }

    /**
     * Gets the form content returns the apropriate
     *
     * @param Form Post Request $request
     * @return view (customer.form or customer.list)
     */
    public function postRegister(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

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
