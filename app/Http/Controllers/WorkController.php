<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Register\WorkRegister;
use App\Work;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class WorkController extends Controller
{
    use WorkRegister;

    protected $redirectTo = '/work/form';

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
    public function getById($idValue)
    {
        $header = "Selected Work";
        $work = Work::find($idValue);
        //$employees = User::where('id', $idValue)->get();
        //dd($employee);


        MapController::generateWorkMap($work);

        return view('work/work')
            ->with('work', $work)
            ->with('header', $header);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorkForm()
    {
        return $this->showRegistrationForm();
    }

    public function addNew(Request $request)
    {
        return $this->register($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnfinished()
    {
        $header = "Unfinished Works";
        $works = Work::where('finished', 0)->get();

        MapController::generateWorksMap($works);

        return view('work/works')
            ->with('works', $works)
            ->with('header', $header);
    }

    public function getFinished()
    {
        $header = "Finished Works";
        $works = Work::where('finished', 1)->get();

        MapController::generateWorksMap($works);

        return view('work/works')
            ->with('works', $works)
            ->with('header', $header);
    }

    public function getAll()
    {
        $header = "All Works";
        $works = Work::all();

        MapController::generateWorksMap($works);

        return view('work/works')
            ->with('works', $works)
            ->with('header', $header);
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
            'customer_id' => 'required|integer',
            'address' => 'required|max:255|min:10',
            'description' => 'max:500',

        ]);

        /* 'longitude' => 'between:60,70',
            'latitude' => 'between:20,31',*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Work::create([
            'customer_id' => $data['customer_id'],
            'address' => $data['address'],
            'description' => $data['description'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ]);
    }
}
