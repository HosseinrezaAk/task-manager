<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function authenticate($request, array $guards)
    {
        if(empty($guards)){
            $guards = [null];
        }
        foreach( $guards as $guard){
            dump($guard);
            if($this->auth->guard($guard)->check()){
                return $this->auth->shouldUse($guard);
            }
        }
        abort(401, trans("UNAUTHORIZED"));
    }
}
