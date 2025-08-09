<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use App\Http\Requests\AnimeRequest;

class MyAnimeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('limit', 15);
        $perPage = max(1, min($perPage, 100));

        $query = Anime::query();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $results = $query->paginate($perPage)->withQueryString();

        return response()->json([
            'data' => $results->items(),
            'meta' => [
                'current_page' => $results->currentPage(),
                'last_page' => $results->lastPage(),
                'per_page' => $results->perPage(),
                'total' => $results->total(),
            ],
            'links' => [
                'first' => $results->url(1),
                'last' => $results->url($results->lastPage()),
                'prev' => $results->previousPageUrl(),
                'next' => $results->nextPageUrl(),
            ],
        ]);
    }

    // GET /api/anime/{id}
    public function show($id)
    {
        $anime = Anime::find($id);
        if(!$anime) return response()->json(['message' => 'Anime tidak ditemukan'], 404);
        return response()->json($anime);
    }

    // PUT /api/anime/{id}
    public function update(AnimeRequest $request, $id)
    {
        $anime = Anime::with('videos')->find($id);
        if(!$anime) return response()->json(['message' => 'Anime tidak ditemukan'], 404);
        $anime->update($request->validated());
        return response()->json([
            'data' => $anime,
            'videos' => $anime->videos
        ]);
    }

    // DELETE /api/anime/{id}
    public function destroy($id)
    {
        $anime = Anime::find($id);
        if(!$anime) return response()->json(['message' => 'Anime tidak ditemukan'], 404);
        $anime->delete();
        return response()->json(['message' => 'Anime dihapus']);
    }
}