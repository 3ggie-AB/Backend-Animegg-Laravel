<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'main_picture' => 'nullable|array',
            'alternative_titles' => 'nullable|array',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'synopsis' => 'nullable|string',
            'mean' => 'nullable|numeric',
            'rank' => 'nullable|integer',
            'popularity' => 'nullable|integer',
            'num_list_users' => 'required|integer',
            'num_scoring_users' => 'required|integer',
            'nsfw' => ['nullable', Rule::in(['white', 'gray', 'black'])],
            'genres' => 'nullable|array',
            'media_type' => ['required', Rule::in(['unknown', 'tv', 'ova', 'movie', 'special', 'ona', 'music'])],
            'status' => ['required', Rule::in(['finished_airing', 'currently_airing', 'not_yet_aired'])],
            'my_list_status' => 'nullable|array',
            'num_episodes' => 'required|integer',
            'start_season' => 'nullable|array',
            'broadcast' => 'nullable|array',
            'source' => ['nullable', Rule::in([
                'other', 'original', 'manga', '4_koma_manga', 'web_manga', 'digital_manga',
                'novel', 'light_novel', 'visual_novel', 'game', 'card_game',
                'book', 'picture_book', 'radio', 'music'
            ])],
            'average_episode_duration' => 'nullable|integer',
            'rating' => ['nullable', Rule::in(['g', 'pg', 'pg_13', 'r', 'r+', 'rx'])],
            'studios' => 'nullable|array',
            'pictures' => 'nullable|array',
            'background' => 'nullable|string',
            'related_anime' => 'nullable|array',
            'related_manga' => 'nullable|array',
            'recommendations' => 'nullable|array',
            'statistics' => 'nullable|array',
        ];
    }
}
