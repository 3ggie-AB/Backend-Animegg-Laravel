<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    public static function getAllColumns()
    {
        return [
            'id',
            'title',
            'main_picture',
            'alternative_titles',
            'start_date',
            'end_date',
            'synopsis',
            'mean',
            'rank',
            'popularity',
            'num_list_users',
            'num_scoring_users',
            'nsfw',
            'genres',
            'created_at_api',
            'updated_at_api',
            'media_type',
            'status',
            'my_list_status',
            'num_episodes',
            'start_season',
            'broadcast',
            'source',
            'average_episode_duration',
            'rating',
            'studios',
            'pictures',
            'background',
            'related_anime',
            'related_manga',
            'recommendations',
            'statistics',
        ];
    }
    public static function sendReq($url, $body)
    {
        try {
            $clientId = env('MAL_CLIENT_ID');
            $response = Http::withHeaders([
                'X-MAL-CLIENT-ID' => $clientId,
            ])->get($url, $body);

            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to fetch anime data from MAL',
                'message' => $e->getMessage(),
            ];
        }
    }

    public static function topAnimeSedangTayang($limit = 8, $offset = 0)
    {
        $url = "https://api.myanimelist.net/v2/anime/ranking";
        $body = [
            'ranking_type' => 'airing',
            'limit' => $limit,
            'offset' => $offset,
        ];
        return self::sendReq($url, $body);
    }
    public static function topAnimeFavorite($limit = 8, $offset = 0)
    {
        $url = "https://api.myanimelist.net/v2/anime/ranking";
        $body = [
            'ranking_type' => 'favorite',
            'limit' => $limit,
            'offset' => $offset,
        ];
        return self::sendReq($url, $body);
    }
    public static function allListAnime($limit = 10, $offset = 0, $search = null, $columns = null)
    {
        $url = "https://api.myanimelist.net/v2/anime";
        $body = [
            'limit' => $limit,
            'offset' => $offset,
            'fields' =>  $columns,
        ];
        if ($search) {
            $body['q'] = $search;
        } else {
            $body['q'] = 'o';
        }
        return self::sendReq($url, $body);
    }
    public static function getAnimeById($id, $columns = null)
    {
        $url = "https://api.myanimelist.net/v2/anime/{$id}";
        $body = [
            'fields' => $columns,
        ];
        return self::sendReq($url, $body);
    }
}
