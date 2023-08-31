<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;


class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'filteruser' => \App\Filters\FilterUser::class,
        'filternasabah' => \App\Filters\FilterNasabah::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'filteruser' => ['except' => [
                'auth', 'auth/*',
                'home', 'home/*',
                '/',

            ]],
            'filternasabah' => ['except' => [
                'auth', 'auth/*',
                'home', 'home/*',
                '/',

            ]]
        ],
        'after' => [
            'filteruser' => ['except' => [
                'auth', 'auth/*',
                'home', 'home/*',
                '/',
            ]],
            'filternasabah' => ['except' => [
                'auth', 'auth/*',
                'home', 'home/*',
                '/',
                'nasabah', 'nasabah/*',


            ]],
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [];
}
