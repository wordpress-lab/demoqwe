<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class ArrayRequestFlat extends Facade{
    protected static function getFacadeAccessor() { return 'ArrayFlat'; }
}
