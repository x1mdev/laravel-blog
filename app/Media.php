<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Media as BaseMedia;

class Media extends BaseMedia
{
    /**
     * Get the media's url.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('media.show', ['medium' => $this]);
    }
}
