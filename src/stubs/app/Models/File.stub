<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

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
