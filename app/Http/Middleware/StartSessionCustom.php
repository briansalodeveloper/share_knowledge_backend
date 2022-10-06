<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;
use Illuminate\Http\Request;
use Closure;

class StartSessionCustom extends StartSession
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $this->sessionConfigured()) {
            return $next($request);
        }

        // If a session driver has been configured, we will need to start the session here
        // so that the data is ready for an application. Note that the Laravel sessions
        // do not make use of PHP "native" sessions in any way since they are crappy.
        $request->setLaravelSession(
            $session = $this->startSession($request)
        );

        $this->collectGarbage($session);

        $response = $next($request);

        $this->storeCurrentUrl($request, $session);

        $this->addCookieToResponse($response, $session);

        // Again, if the session has been configured we will need to close out the session
        // so that the attributes may be persisted to some storage medium. We will also
        // add the session identifier cookie to the application response headers now.
        $this->saveSession($request);

        return $response;
    }

    // overwrite getSession function in StartSession class
    public function getSession(Request $request)
    {
        $session = $this->manager->driver();
        $token = rawurldecode($request->token);

        //Init session from params token
        //Disable init session from cookie
        $session->setId($token);
        
        return $session;
    }

    // overwrite startSession function in StartSession class
    protected function startSession(Request $request)
    {
        return tap($this->getSession($request), function ($session) use ($request) {
            $session->setRequestOnHandler($request);

            $session->start();
        });
    }
}