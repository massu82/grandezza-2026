<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MinifyHtml
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (!app()->environment('production')) {
            return $response;
        }

        if ($response instanceof Response && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $content = $response->getContent();
            if ($content) {
                // Compact whitespace between tags and collapse multi-space runs.
                $content = preg_replace('~>\s+<~', '><', $content);
                $content = preg_replace('/\s{2,}/', ' ', $content);
                $response->setContent(trim($content));
            }
        }

        return $response;
    }
}
