<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TrackPageVisit
{
    private static ?bool $hasTable = null;

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldTrack($request, $response)) {
            return $response;
        }

        try {
            if (self::$hasTable === null) {
                self::$hasTable = Schema::hasTable('page_visits');
            }

            if (! self::$hasTable) {
                return $response;
            }

            $visitorId = $request->cookie('rtm_visitor_id') ?: (string) Str::uuid();
            $path = '/' . ltrim($request->path(), '/');
            $path = $path === '/.' ? '/' : $path;

            $recentDuplicate = PageVisit::query()
                ->where('visitor_id', $visitorId)
                ->where('path', $path)
                ->where('visited_at', '>=', now()->subSeconds(30))
                ->exists();

            if (! $recentDuplicate) {
                PageVisit::create([
                    'visitor_id' => $visitorId,
                    'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                    'ip_hash' => $request->ip() ? hash('sha256', $request->ip()) : null,
                    'user_agent' => Str::limit((string) $request->userAgent(), 1000, ''),
                    'method' => $request->method(),
                    'path' => $path,
                    'full_url' => Str::limit($request->fullUrl(), 2000, ''),
                    'route_name' => $request->route()?->getName(),
                    'referrer' => Str::limit((string) $request->headers->get('referer'), 1000, ''),
                    'status_code' => $response->getStatusCode(),
                    'visited_at' => now(),
                ]);
            }

            if (! $request->cookies->has('rtm_visitor_id')) {
                Cookie::queue(cookie('rtm_visitor_id', $visitorId, 60 * 24 * 365, null, null, false, true, false, 'Lax'));
            }
        } catch (Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Page visit tracking failed: ' . $e->getMessage(), ['exception' => $e]);
            return $response;
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || $response->getStatusCode() >= 500) {
            return false;
        }

        if ($request->is('admin*') || $request->is('api*') || $request->is('_debugbar*')) {
            return false;
        }

        $path = $request->path();
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (in_array($extension, ['css', 'js', 'map', 'png', 'jpg', 'jpeg', 'gif', 'webp', 'svg', 'ico', 'avif', 'woff', 'woff2', 'ttf'], true)) {
            return false;
        }

        $agent = strtolower((string) $request->userAgent());

        return ! Str::contains($agent, ['bot', 'crawl', 'spider', 'slurp', 'preview']);
    }
}
