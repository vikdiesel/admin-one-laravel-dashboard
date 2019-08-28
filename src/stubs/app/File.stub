<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $appends  = [
        'url'
    ];

    public function getUrlAttribute() {
        if (empty($this->file)) {
            return null;
        }

        return Storage::url($this->file);
    }
}
