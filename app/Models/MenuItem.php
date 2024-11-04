<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
