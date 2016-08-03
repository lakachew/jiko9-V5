<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests;
use App\Map;
use App\UserWork;
use App\Work;
use App\Worklog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Double;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTController extends ApiController
{
    /**
     * Authenticate the user when request for authentication using JWT
     *
     */
    protected function authenticate()
    {
        //dd('i am here');
        //check if all required arguments have values
        if(!Input::get('email') or !Input::get('password'))
        {
            return $this->respondMissing('missing credential');
        }



        // holding the posted values expected to be an email and password key value pair
        $email = Input::get('email');
        $password = Input::get('password');

        try{
            if (! $token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
                //return response()->json(['error' => 'invalid_credentials'], 401);
                return $this->invalidCredential('invalid cridentials');
            }
        }catch (JWTException $e) {
            // Error handling: informing 'something went wrong'
            //return response()->json(['error' => 'could_not_create_token'], 500);
            return $this->respondNotFound('could not create token');
        }

        //$userMysql = DB::table('users')->where('id', $user->id)->get();

        //get the authenticated user and convert it to an array
        $user = Auth::user();
        $userArray = $user->toArray();

        $token2 = JWTAuth::fromUser($user, $userArray);

        //return response()->json(compact('token'));
        return $this->jsonResponse($token2);

    }

    /***
     * Returns user cridential for an Authenticated access using JWT
     * @return json
     */
    protected function getAuthenticatedUser()
    {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->invalidCredential('user_not_found');
            }

        } catch (TokenExpiredException $e) {
            return $this->exceptionThrowResponse("token_expired", $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return $this->exceptionThrowResponse("token_invalid", $e->getStatusCode());

        } catch (JWTException $e) {
            return $this->exceptionThrowResponse("token_absent", $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return $this->jsonResponse($user);

    }

    /***
     * Returns user cridential for an Authenticated access using JWT
     * @return json
     */
    protected function getUserWorks()
    {

        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->invalidCredential('user_not_found');
            }

        } catch (TokenExpiredException $e) {
            return $this->exceptionThrowResponse("token_expired", $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return $this->exceptionThrowResponse("token_invalid", $e->getStatusCode());

        } catch (JWTException $e) {
            return $this->exceptionThrowResponse("token_absent", $e->getStatusCode());

        }

        $assignedworks = collect();


        $userWorks = UserWork::where('user_id', $user->id)->get();

        foreach ($userWorks as $userWork)
        {
            $work = DB::table('works')->select('finished','address','description')
                ->where('id', $userWork->work_id)->first();

            if(!$work->finished)
            {
                $assignedwork = collect($userWork);
                $assignedwork->put('address', $work->address);
                $assignedwork->put('description', $work->description);
                $assignedwork->put('finished', $work->finished);

                $assignedworks->prepend($assignedwork);
            }
        }
        // the token is valid and we have found the user via the sub claim
        return $this->jsonResponse($assignedworks);

    }

    public function getStartedWorklogByUserWorkId()
    {

        $activeWorkResponse = Collect();

        /*
         *      accessing the userWorkId from the posted request
         */
        if(!$userWorkId = Input::get('user_work_id'))
        {
            return $this->respondMissing('missing credential');
        }

        /*
         *      Get the authenticated User
         */
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->invalidCredential('user_not_found');
            }

            foreach ($user->worklogs as $worklog)
            {
                $id = (int) $userWorkId;

                if($worklog->user_work_id == $id )
                {
                    if($map = Map::where('worklog_id', $worklog->id)->get())
                    {

                        $count = Map::where('worklog_id', $worklog->id)->count();

                        if($count == 1)
                        {
                            if($map->first())
                            {
                                if ($map->first()->start == 1)
                                {
                                    $activeWorkResponse->prepend($map[0]);
                                    break;
                                }
                            }
                        }

                    }
                }
            }
        } catch (TokenExpiredException $e) {
            return $this->exceptionThrowResponse("token_expired", $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return $this->exceptionThrowResponse("token_invalid", $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->exceptionThrowResponse("token_absent", $e->getStatusCode());
        }

        return $this->jsonResponse($activeWorkResponse);
    }

    public function setStartedMap()
    {
        $addedMap = collect();

        /*
         *      accessing the Map Post parameters
         */
        $latitude = (double) Input::get('latitude');
        $longitude = (double) Input::get('longitude');
        $userWorkId = (int) Input::get('user_work_id');
        $description = (String) Input::get('description');
        if(!$latitude || !$longitude || !$userWorkId)
        {
            return $this->respondMissing('missing credential');
        }


        /*
         *      Get the authenticated User
         */
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->invalidCredential('user_not_found');
            }

            $workLogResult = Worklog::create([
                'user_work_id' => $userWorkId,
                'description' => $description,
            ]);


            $mapResult = Map::create([
                'longitude' => $longitude,
                'latitude' => $latitude,
                'start' => 1,
                'worklog_id' => $workLogResult->id,
            ]);

            $addedMap->prepend($mapResult);


        } catch (TokenExpiredException $e) {
            return $this->exceptionThrowResponse("token_expired", $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return $this->exceptionThrowResponse("token_invalid", $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->exceptionThrowResponse("token_absent", $e->getStatusCode());
        }

        return $this->jsonResponse($addedMap);

    }

    public function setStopedMap()
    {
        $addedMap = collect();

        /*
         *      accessing the Map Post parameters
         */
        $latitude = (double) Input::get('latitude');
        $longitude = (double) Input::get('longitude');
        $worklogId = (int) Input::get('worklog_id');
        if(!$latitude || !$longitude || !$worklogId)
        {
            return $this->respondMissing('missing credential');
        }


        /*
         *      Get the authenticated User
         */
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return $this->invalidCredential('user_not_found');
            }

            $mapResult = Map::create([
                'longitude' => $longitude,
                'latitude' => $latitude,
                'start' => 0,
                'worklog_id' => $worklogId,
            ]);

            $addedMap->prepend($mapResult);


        } catch (TokenExpiredException $e) {
            return $this->exceptionThrowResponse("token_expired", $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return $this->exceptionThrowResponse("token_invalid", $e->getStatusCode());
        } catch (JWTException $e) {
            return $this->exceptionThrowResponse("token_absent", $e->getStatusCode());
        }

        return $this->jsonResponse($addedMap);

    }
}
