<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

class PositionHelper
{
    /**
     * @param  class-string<Model>  $modelClass
     */
    public static function next(string $modelClass): int
    {
        return (int) ($modelClass::query()->max('position') ?? -1) + 1;
    }
}
