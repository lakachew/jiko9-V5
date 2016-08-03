<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Response;


class ApiController extends Controller
{
    const HTTP_NOT_FOUND = 404;

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);
        //in the above return we are chaining and when ever we chain we
        //should return the object (in the setStatusCode function)
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function invalidCredential($message = 'Not Found!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
        //in the above return we are chaining and when ever we chain we
        //should return the object (in the setStatusCode function)
    }



    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function exceptionThrowResponse($message, $statusCode)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $statusCode
            ]
        ]);
    }

    /**
     * @param  $message
     * @return mixed
     */
    protected function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            'status' => 'success',
            'message' => $message
        ]);
    }


    /**
     * @param  $message
     * @return mixed
     */
    protected function jsonResponse($data)
    {
        $this->setStatusCode(IlluminateResponse::HTTP_ACCEPTED);
        //$data.append
        /*array_push($data,
            ['status' => 'success',
            'message' => 'User is authenticated']);*/
        //dd($data);

        //dd($data);
        //return Response::json($data);

        return Response::json($data, $this->getStatusCode(), [
            'status' => 'success',
            'message' => 'User is authenticated']);

    }


    /**
     * @return mixed
     */
    protected function respondMissing($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }
}
