<?php

namespace Darbe\SecurePayload\Facades;

use Illuminate\Support\Facades\Facade;

class SecurePayload extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'secure-payload';
    }
}
