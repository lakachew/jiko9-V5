<?php

namespace App\Http\Controllers;

use App\Work;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use \GoogleMaps\GoogleMaps as GoogleMaps;

use App\Http\Requests;
use Mockery\CountValidator\Exception;

class MapController extends Controller
{
    public static function getAllLongitudeAndLatitude($addresses)
    {
        $collection = collect();

        foreach ($addresses as $address)
        {
            $response = (array) \GoogleMaps::load('geocoding')
                ->setParam(['address' => $address])
                ->get();


            $longitude = json_decode($response[0])->results[0]->geometry->location->lat;
            $latitude = json_decode($response[0])->results[0]->geometry->location->lng;

            $collection = $collection->merge([$longitude, $latitude]);
        }

        return $collection->all();
    }

    public static function getLongitudeAndLatitude($address)
    {
        $collection = collect();

        try
        {
            $response = (array) \GoogleMaps::load('geocoding')
                ->setParam(['address' => $address])
                ->get();

            $longitude = json_decode($response[0])->results[0]->geometry->location->lat;
            $latitude = json_decode($response[0])->results[0]->geometry->location->lng;

            $collection = $collection->merge([$longitude, $latitude]);
        }catch (\ErrorException $e)
        {
            $collection = collect(['error' => 'Address not found']);
        }

        //dd($response);

        return $collection->all();
    }

    public static function generateWorkMap($work)
    {
        $work = Work::find($work['id']);

        if(isset($work->longitude) && isset($work->latitude)) {
            Mapper::map($work->longitude ,$work->latitude,
                ['draggable' => false,
                    'eventMouseDown' => 'console.log("mouse down");',
                    'zoom' => 12,
                    'cluster' => false,
                    'markers' =>
                        ['title' => $work['address'],
                            'scale' => 1000,
                            'animation' => 'DROP']]);
        }
        else
        {
            Mapper::map(63.0925796,21.6516582,
                ['draggable' => false,
                    'eventMouseDown' => 'console.log("mouse down");',
                    'zoom' => 12,
                    'cluster' => false]);
        }

    }

    public static function generateWorksMap($works)
    {
        Mapper::map(63.0925796,21.6516582,
            ['draggable' => false,
                'eventMouseDown' => 'console.log("mouse down");',
                'zoom' => 12,
                'cluster' => false,
                'markers' =>
                    [ 'title' => 'Jiko Oy',
                        'scale' => 1000,
                        'animation' => 'DROP']]);

        foreach($works as $work)
        {
            $work = Work::find($work['id']);
            $workCustomer = $work->getCustomerName();
            if(isset($work['longitude']))
            {
                Mapper::informationWindow($work['longitude'],$work['latitude'], $workCustomer,
                    ['clusters' => ['size' => 10, 'center' => true, 'zoom' => 15],
                        'markers' => ['symbol' => 'circle',
                            'scale' => 1000,
                            'animation' => 'DROP']]);
            }

        }

    }

    public static function generateEmployeesMap($employees)
    {
        Mapper::map(63.0925796,21.6516582,
            ['draggable' => false,
                'eventMouseDown' => 'console.log("mouse down");',
                'zoom' => 12,
                'cluster' => false,
                'markers' =>
                    [ 'title' => 'Jiko Oy',
                        'scale' => 1000,
                        'animation' => 'DROP']]);

        foreach($employees as $employee)
        {
            Mapper::informationWindow($employee['longitude'],$employee['latitude'], '<a href="http://jiko9.app/">Lakachew Home</a>',
                ['clusters' => ['size' => 10, 'center' => true, 'zoom' => 15],
                    'markers' => ['symbol' => 'circle',
                        'scale' => 1000,
                        'animation' => 'DROP']]);
        }

    }
}

//General URL: "https://maps.googleapis.com/maps/api/staticmap?parameters"

/**
 * Location required parameters if markers are not present
 *      center: can be represented in two form
 *              1. coordinates (20.541654,-55.65213548)
 *              2. Street names ("HS center, vaasa, fi")
 *      zoom: value between (0,21); temporarely building outlines, appear on the map at zoom=17
 *              1:World
 *              5: Landmass/continent
 *              10:City
 *              15: Streets
 *              20:Buildings
 *
 * Map parameters
 *      size (required): {horizontal_value}x{vertical_value} in string form
 *              - is affected by scale parameter
 *      scale (optional): {scale=1} max value is 4 but it is only accessible by premium plan customers.
 *
 *      format (optional): GIF, JPEG AND PNG
 *
 *      maptype (optional): roadmap(default), satellite, hubrid, and terrain
 *
 *      language (optional):
 *
 *      region (optional): accepts two charactor code
 *
 * Feature Parameters
 *      markers (optional): multiple cimilar markers are separated by (|) reffer :- https://developers.google.com/maps/documentation/static-maps/intro#URL_Parameters
 *                  example:- markers=markerStyles|markerLocation1| markerLocation2|.
 *      path (optional): string of point separated by (|)
 *
 *      visible (optional): to hide or show the map
 *              example: https://maps.googleapis.com/maps/api/staticmap?center=Boston,MA&visible=77+Massachusetts+Ave,Cambridge,MA%7CHarvard+Square,Cambridge,MA&size=512x512&key=YOUR_AP
 *
 *      style (optional): feature and element arguments identify the features and apply to the that selection.
 *              marker style key value pair
 *                  size: (optional)
 *                  color: (optional) {black, brown, green, purple, yellow, blue, gray, orange, red, white}
 *                  label: (optional) specifies a single uppercase alphanumeric character i.e {A-Z,0-9}
 *
 *
 * Key and Signature Parameters
 *
 *      key (required): allows to monitor application api usage.
 *
 *      signature (recommended): security for only my app access it
 *
 * **************************************
 * Latitudes: value between (-90,90) and  6 decimal places
 * Longitude: value between (-180,180) and 6 decimal places
 */

/*
$url = https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
    &markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318
    &markers=color:red%7Clabel:C%7C40.718217,-73.998284
    &key=YOUR_API_KEY;

simillar markers
    https://maps.googleapis.com/maps/api/staticmap?center=Williamsburg,Brooklyn,NY&zoom=13&size=400x400&
    markers=color:blue%7Clabel:S%7C11211%7C11206%7C11222&key=YOUR_API_KEY;

with different markers
    https://maps.googleapis.com/maps/api/staticmap?center=63.259591,-144.667969&zoom=6&size=400x400\
    &markers=color:blue%7Clabel:S%7C62.107733,-145.541936&markers=size:tiny%7Ccolor:green%7CDelta+Junction,AK\
    &markers=size:mid%7Ccolor:0xFFFF00%7Clabel:C%7CTok,AK"&key=YOUR_API_KEY

*/
