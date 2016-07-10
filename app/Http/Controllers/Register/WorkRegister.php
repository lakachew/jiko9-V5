<?php
/**
 * Created by PhpStorm.
 * User: lakachew
 * Date: 29/06/2016
 * Time: 19:57
 */

namespace App\Http\Controllers\Register;


use App\Customer;
use App\Http\Controllers\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait WorkRegister
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

        $customers = Customer::all()->sortBy('contact_name');

        return view('work.form')->with('customers', $customers);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $address = $request->address;

        $request->merge(['longitude' => 0,'latitude' => 0 ]);

        //dd($request);
        $longitudeAndLatitude = MapController::getLongitudeAndLatitude($address);

        //dd($longitudeAndLatitude);

        if(isset($longitudeAndLatitude[1])&& $longitudeAndLatitude[0])
        {
            $longitude = (double) $longitudeAndLatitude[0];
            $latitude = (double) $longitudeAndLatitude[1];

            if($longitude > 59 && $longitude < 71
                &&
                $latitude > 19 && $latitude < 32)
            {
                $request->merge(['longitude' => $longitude,'latitude' => $latitude]);
            }else
            {
                Session::put(['address_error_message' => 'Please provide address located in Finland only.']);
                $request->merge(['address' => '']);
            }

        }else
        {
            Session::put(['address_error_message' => 'Please provide address like (street, postal code and city.)']);
            $request->merge(['address' => '']);
        }

        $validator = $this->validator($request->all());
        $request->merge(['address' => $address]);

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
