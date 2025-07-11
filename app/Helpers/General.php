<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin() {
        return Auth::user()->isAdmin();
    }
}

if (!function_exists('listPoli')) {
    function listPoli() {
        return [
            'poli-umum' => [
                'id' => 1,
                'name' => 'Poli Umum',
                'slug' => 'poli-umum',
                'price' => 50000
            ],
            'poli-gigi' => [
                'id' => 2,
                'name' => 'Poli Gigi',
                'slug' => 'poli-gigi',
                'price' => 100000
            ],
            'poli-mata' => [
                'id' => 3,
                'name' => 'Poli Mata',
                'slug' => 'poli-mata',
                'price' => 150000
            ],
        ];
    }
}