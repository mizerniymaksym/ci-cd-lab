<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && $request->header('X-User-Role') !== 'admin') {
            return response()->json([
                'status' => 'access_denied',
                'message' => 'Відхилено: керувати базою місць може лише адміністратор (потрібен заголовок X-User-Role: admin).',
            ], 403);
        }

        $response = $next($request);

        $response->headers->set('X-Security-Policy', 'Enforced');

        return $response;
    }
}
