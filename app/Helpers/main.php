<?php

if(!function_exists('getApi')) {
    function getApi() {
        return [
            [
                'name' => 'Login',
                'url' => url('/api/login'),
                'parameter' => [
                    'email', 'password'
                ],
                'method' => 'POST'
            ],
            [
                'name' => 'Register',
                'url' => url('/api/register'),
                'parameter' => [
                    'name', 'email', 'password'
                ],
                'method' => 'POST'
            ]
        ];
    }
}