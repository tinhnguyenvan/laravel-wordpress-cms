<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // get cookie
        $locale = Cookie::get('locale', config('app.locale'));
        // load request header
        if ($request->has('lang')) {
            $languageRequest = $request->input('lang');
        } else {
            $languageRequest = $locale;
        }

        // verify
        if (in_array($languageRequest, ['vi', 'en']) && $languageRequest != $locale) {
            $locale = $languageRequest;
            return redirect(url()->current())->withCookie(cookie()->forever('locale', $locale));
        }

        // use locale
        config(['app.locale' => $locale]);
        config(['app.fallback_locale' => $locale]);
        return $next($request);
    }
}
