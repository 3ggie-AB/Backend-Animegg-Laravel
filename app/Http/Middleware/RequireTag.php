<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireTag
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('require.tag:create-anime,Admin')
     */
    public function handle(Request $request, Closure $next, ...$requiredTags): Response
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $tags = $user->tags;

        if (is_string($tags)) {
            // attempt decode if stored as string
            $decoded = json_decode($tags, true);
            $tags = is_array($decoded) ? $decoded : null;
        }

        if (! is_array($tags)) {
            return response()->json(['message' => 'User has no valid tags.'], 403);
        }

        // normalize to simple strings
        $normalized = array_map('strval', $tags);

        // require at least one of the provided requiredTags
        $has = false;
        foreach ($requiredTags as $t) {
            if (in_array($t, $normalized, true)) {
                $has = true;
                break;
            }
        }

        if (! $has) {
            return response()->json([
                'message' => 'Insufficient permissions. Required tag(s): '.implode(', ', $requiredTags)
            ], 403);
        }

        return $next($request);
    }
}
