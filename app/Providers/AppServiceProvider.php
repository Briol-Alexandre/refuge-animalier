<?php

namespace App\Providers;

use App\Enums\Status;
use App\Models\Notifications;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => auth()->user(),
                ];
            },
            'notificationCount' => fn() => Notifications::where('read', false)->count(),
            'statusList' => Status::cases(),
            'exports' => function () {

                $files = Storage::disk('s3')->files('pdfs');

                return collect($files)->map(function ($file) {
                    return [
                        'name' => basename($file),
                        'url' => Storage::disk('s3')->url($file),
                        'size' => Storage::disk('s3')->size($file),
                        'created_at' => Storage::disk('s3')->lastModified($file),
                    ];
                });
            }
        ]);
    }
}
