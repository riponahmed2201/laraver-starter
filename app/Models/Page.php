<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['id'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile(); //if added this singleFile() previous file removed then new file added
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->where('status', true)->firstOrFail();
    }
}
