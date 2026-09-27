<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePrivacyAccepted
{
    public function handle(Request $request, Closure $next): Response
    {

        if (!session()->get('privacy_accepted')) {

            if ($request->isMethod('GET')) {
                session([
                    'privacy_redirect' => $request->fullUrl()
                ]);
            }

            return redirect()
                ->route('data.privacy')
                ->with(
                    'warning',
                    'Please read and accept the Data Privacy Policy before continuing.'
                );
        }

        return $next($request);
    }
}