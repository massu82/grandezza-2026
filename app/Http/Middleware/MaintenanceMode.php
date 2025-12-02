<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Permitir admin y panel aún en mantenimiento
        if (
            $request->is('admin/*') || $request->is('admin')
            || $request->is('panel/*') || $request->is('panel')
            || $request->is('preview-home')
        ) {
            return $next($request);
        }

        $settings = cache()->remember('app_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        $isMaintenance = isset($settings['maintenance']) && (int) $settings['maintenance'] === 1;

        if ($isMaintenance && app()->environment('production')) {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}
