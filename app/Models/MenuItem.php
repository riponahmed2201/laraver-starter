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

    public function childs()
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id', 'id');
    }
}
