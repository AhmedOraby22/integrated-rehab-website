<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (HttpException $e, Request $request) {
            $isCsrfMismatch = $e->getStatusCode() === 419
                || $e->getPrevious() instanceof TokenMismatchException;

            if (! $isCsrfMismatch) {
                return null;
            }

            if ($request->is('contact') || $request->routeIs('contact.store')) {
                $redirect = $request->input('redirect_to') === 'home'
                    ? redirect()->route('home')->withFragment('contact-us')
                    : redirect()->route('contact');

                return $redirect
                    ->withInput($request->except('_token'))
                    ->withErrors([
                        'session' => 'Your session expired. Please submit the form again.',
                    ]);
            }

            return redirect()
                ->back()
                ->withInput($request->except('_token', 'password', 'password_confirmation'))
                ->withErrors([
                    'session' => 'Your session expired. Please try again.',
                ]);
        });
    })->create();
