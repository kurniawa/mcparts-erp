<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                // 'session' => [
                //     'success_' => $request->session()->get('success_'),
                //     'warnings_' => $request->session()->get('warnings_'),
                //     'errors_' => $request->session()->get('errors_'),
                // ],
                // 'session' => $request->session()->get('session')
            ],
            'session' => function () use ($request) {
                return [
                    'success_' => $request->session()->get('success_'),
                    'warnings_' => $request->session()->get('warnings_'),
                    'errors_' => $request->session()->get('errors_'),
                ];
            },
        ];
    }
}
