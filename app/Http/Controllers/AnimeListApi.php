<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnimeListApi extends Controller
{
    public function AllAnime(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => ['nullable', 'integer', 'min:1', 'max:100'],
            'offset' => ['nullable', 'integer', 'min:0'],
            'search' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'request' => $request->all(),
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $limit = $validated['limit'] ?? 10;
        $offset = $validated['offset'] ?? 0;
        $search = $validated['search'];

        // Asumsikan method ini mengembalikan array nama-nama kolom dari API
        $columns = implode(',', AnimeController::getAllColumns());

        // Ambil list anime menggunakan method dari AnimeController
        return AnimeController::allListAnime($limit, $offset, $search, $columns);
    }

    public function getAnimeById(Request $request)
    {
        $id = $request->input('id');
        if (!is_numeric($id) || $id <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid anime ID',
            ], 400);
        }

        $columns = implode(',', AnimeController::getAllColumns());
        $anime = AnimeController::getAnimeById($id, $columns);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $anime,
        ]);
    }

    public function saveAnime(Request $request)
    {
        $id = $request->input('id');
        if (!is_numeric($id) || $id <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid anime ID',
            ], 400);
        }

        $columns = implode(',', AnimeController::getAllColumns());
        $anime = AnimeController::getAnimeById($id, $columns);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime not found',
            ], 404);
        }
        $savedAnime = Anime::where('id', $id)->first();
        if ($savedAnime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime already saved',
            ], 400);
        }else{
            $savedAnime = Anime::create($anime);
        }

        return response()->json([
            'success' => true,
            'message' => 'Anime saved successfully',
            'Anime Saved' => $savedAnime,
            'data' => $anime,
        ]);
    }
}
