<?php

namespace ZubikIT\AlfaBank\Facades;

use Illuminate\Support\Facades\Facade;

class AlfaBank extends Facade
{
    protected static function getFacadeAccessor() {
        return \ZubikIT\AlfaBank\Services\AlfaBankService::class;
    }
}
