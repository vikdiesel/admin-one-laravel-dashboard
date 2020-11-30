<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Processors\AvatarProcessor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $appends = [
        'created'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'file_id',
        'file'
    ];

    protected $fillable = [
        'name',
        'company',
        'city',
        'progress',
        'created_date',
        'file_id'
    ];

    public function file() {
        return $this->belongsTo(File::class);
    }

    public function getAvatarFilenameAttribute() {
        if (!empty($this->file)) {
            return $this->file->name;
        }

        return null;
    }

    public function getAvatarAttribute() {
        return AvatarProcessor::get($this);
    }

    public function getCreatedAttribute() {
        if (empty($this->created_at)) {
            return null;
        }

        return $this->created_at->toFormattedDateString();
    }

    public function getCreatedMmDdYyyyAttribute() {
        if (empty($this->created_at)) {
            return null;
        }

        return $this->created_at->format('m-d-Y');
    }

    public function setCreatedDateAttribute( $value ) {
        try {
            $this->attributes['created_at'] = new Carbon($value);
        } catch (\Exception $exception) {
            $this->attributes['created_at'] = now();
        }
    }
}
