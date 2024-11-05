<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class)->doesntHave('parent')->orderBy('order', 'asc');
    }
}
