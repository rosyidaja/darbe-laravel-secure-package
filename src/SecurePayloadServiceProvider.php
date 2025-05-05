<?php

namespace Darbe\SecurePayload;

use Illuminate\Support\ServiceProvider;

class SecurePayloadServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('secure-payload', function () {
            return new SecurePayload();
        });
    }

    public function boot()
    {
        //
    }
}
