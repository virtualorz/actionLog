<?php

namespace Virtualorz\ActionLog\Facades;

use Illuminate\Support\Facades\Facade;

class ActionLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'actionLog';
    }
}
