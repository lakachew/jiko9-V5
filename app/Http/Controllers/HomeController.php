<?php


namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Map;
use App\UserWork;
use App\Work;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use \GoogleMaps as GoogleMaps;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::where('finished', 0)->get();

        MapController::generateWorksMap($works);

        return view('home')
            ->with('works', $works);
    }

}
