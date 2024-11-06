<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = ['id'];

    public static function getByName(string $name, $default = null)
    {
        $setting = self::where('name', $name)->first();

        if (isset($setting)) {
            return $setting->value;
        } else {
            return $default;
        }
    }
}
