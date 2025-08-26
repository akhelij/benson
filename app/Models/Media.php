<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'size',
        'collection_name',
        'mediable_type',
        'mediable_id',
        'custom_properties'
    ];

    protected $casts = [
        'custom_properties' => 'array',
        'size' => 'integer'
    ];

    /**
     * Get the owning mediable model.
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL to the media file.
     */
    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    /**
     * Get the full path to the media file.
     */
    public function getFullPathAttribute()
    {
        return Storage::path($this->path);
    }

    /**
     * Delete the media file from storage when the model is deleted.
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            if (Storage::exists($media->path)) {
                Storage::delete($media->path);
            }
        });
    }

    /**
     * Scope to filter by collection name.
     */
    public function scopeInCollection($query, $collectionName)
    {
        return $query->where('collection_name', $collectionName);
    }
}
