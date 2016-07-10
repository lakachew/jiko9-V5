<?php
/**
 * Created by PhpStorm.
 * User: lakachew
 * Date: 29/06/2016
 * Time: 20:05
 */

namespace App\Http\Controllers\Register;


trait RedirectsForm
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {

        if (property_exists($this, 'redirectPath')) {
            return $this->redirectPath;
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

}
