<?php

if (!function_exists('getApi')) {
    function getApi()
    {
        return [
            [
                'name' => 'Login',
                'url' => url('/api/login'),
                'parameter' => [
                    [
                        'name' => 'email',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'password',
                        'type' => 'string',
                        'required' => true,
                    ],
                ],
                'method' => 'POST',
                // untuk login tidak perlu token
            ],
            [
                'name' => 'Register',
                'url' => url('/api/register'),
                'parameter' => [
                    [
                        'name' => 'name',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'email',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'password',
                        'type' => 'string',
                        'required' => true,
                    ],
                ],
                'method' => 'POST',
            ],
            [
                'name' => 'Cek Token (me)',
                'url' => url('/api/me'),
                'parameter' => [], // tidak ada body, cukup header Authorization: Bearer <token>
                'method' => 'GET',
                'requires_token' => true,
            ],
            [
                'name' => 'Logout',
                'url' => url('/api/logout'),
                'parameter' => [], // tidak ada body, cukup token
                'method' => 'POST',
                'requires_token' => true,
            ],
            [
                'name' => 'Daftar Anime (Anime List)',
                'url' => url('/api/animelist/anime'),
                'parameter' => [
                    [
                        'name' => 'search',
                        'type' => 'string',
                        'required' => false,
                    ],
                    [
                        'name' => 'limit',
                        'type' => 'integer',
                        'required' => false,
                    ],
                    [
                        'name' => 'offset',
                        'type' => 'integer',
                        'required' => false,
                    ],
                ],
                'method' => 'GET',
                'requires_token' => true,
            ],
            [
                'name' => 'Detail Anime (Anime List)',
                'url' => url('/api/animelist/detail-anime'),
                'parameter' => [
                    [
                        'name' => 'id',
                        'type' => 'string',
                        'required' => true,
                    ],
                ],
                'method' => 'GET',
                'requires_token' => true,
            ],
            [
                'name' => 'Simpan Anime (Anime List)',
                'url' => url('/api/animelist/save-anime'),
                'parameter' => [
                    [
                        'name' => 'id',
                        'type' => 'string',
                        'required' => true,
                    ],
                ],
                'method' => 'POST',
                'requires_token' => true,
            ],
            [
                'name' => 'Upload Video',
                'url' => url('/api/upload-video'),
                'parameter' => [
                    [
                        'name' => 'video',
                        'type' => 'file',
                        'required' => true,
                    ],
                    [
                        'name' => 'thumbnail',
                        'type' => 'file',
                        'required' => true,
                    ],
                    [
                        'name' => 'anime_id',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'episode',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'resolution',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'description',
                        'type' => 'string',
                        'required' => false,
                    ],
                ],
                'method' => 'POST',
                'requires_token' => true,
            ],
            [
                'name' => 'Daftar Anime (CRUD)',
                'url' => url('/api/anime'),
                'parameter' => [
                    [
                        'name' => 'search',
                        'type' => 'string',
                        'required' => false,
                    ],
                    [
                        'name' => 'limit',
                        'type' => 'integer',
                        'required' => false,
                    ],
                    [
                        'name' => 'page',
                        'type' => 'integer',
                        'required' => false,
                    ],
                ],
                'method' => 'GET',
                'requires_token' => true,
            ],
            [
                'name' => 'Detail Anime (CRUD)',
                'url' => url('/api/anime/{id}'),
                'parameter' => [
                    [
                        'name' => 'id',
                        'type' => 'integer',
                        'required' => true,
                    ],
                ],
                'method' => 'GET',
                'requires_token' => true,
            ],
            [
                'name' => 'Update Anime (CRUD)',
                'url' => url('/api/anime/{id}'),
                'parameter' => [
                    [
                        'name' => 'id',
                        'type' => 'integer',
                        'required' => true,
                    ],
                    [
                        'name' => 'title',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'num_list_users',
                        'type' => 'integer',
                        'required' => true,
                    ],
                    [
                        'name' => 'num_scoring_users',
                        'type' => 'integer',
                        'required' => true,
                    ],
                    [
                        'name' => 'media_type',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'status',
                        'type' => 'string',
                        'required' => true,
                    ],
                    [
                        'name' => 'num_episodes',
                        'type' => 'integer',
                        'required' => true,
                    ],
                ],
                'method' => 'PUT',
                'requires_token' => true,
            ],
            [
                'name' => 'Hapus Anime (CRUD)',
                'url' => url('/api/anime/{id}'),
                'parameter' => [
                    [
                        'name' => 'id',
                        'type' => 'integer',
                        'required' => true,
                        'binding' => 'id',
                    ],
                ],
                'method' => 'DELETE',
                'requires_token' => true,
            ],

        ];
    }
}
