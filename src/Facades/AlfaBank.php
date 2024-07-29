<?php

namespace SniffRx\AlfaBank\Facades;

use Illuminate\Support\Facades\Facade;

class AlfaBank extends Facade
{
    protected static function getFacadeAccessor() {
        return \SniffRx\AlfaBank\Services\AlfaBankService::class;
    }
}