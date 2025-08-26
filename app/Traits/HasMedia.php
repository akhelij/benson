<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    /**
     * Get all media for this model.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * Get media from a specific collection.
     */
    public function getMedia($collectionName = 'default')
    {
        return $this->media()->inCollection($collectionName)->get();
    }

    /**
     * Get the first media item from a collection.
     */
    public function getFirstMedia($collectionName = 'default')
    {
        return $this->media()->inCollection($collectionName)->first();
    }

    /**
     * Add media to this model.
     */
    public function addMedia(UploadedFile $file, $collectionName = 'default', $customProperties = [])
    {
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
        
        // Create unique filename
        $uniqueFileName = $nameWithoutExtension . '_' . time() . '_' . Str::random(6) . '.' . $extension;
        
        // Store file
        $path = $file->storeAs('media/' . $collectionName, $uniqueFileName, 'public');
        
        // Create media record
        return $this->media()->create([
            'name' => $nameWithoutExtension,
            'file_name' => $uniqueFileName,
            'mime_type' => $file->getMimeType(),
            'path' => $path,
            'size' => $file->getSize(),
            'collection_name' => $collectionName,
            'custom_properties' => $customProperties
        ]);
    }

    /**
     * Delete all media from a collection.
     */
    public function clearMediaCollection($collectionName = 'default')
    {
        $this->media()->inCollection($collectionName)->each(function ($media) {
            $media->delete();
        });
    }

    /**
     * Delete a specific media item.
     */
    public function deleteMedia($mediaId)
    {
        $media = $this->media()->find($mediaId);
        if ($media) {
            $media->delete();
            return true;
        }
        return false;
    }

    /**
     * Get the URL of the first media in a collection.
     */
    public function getFirstMediaUrl($collectionName = 'default', $default = null)
    {
        $media = $this->getFirstMedia($collectionName);
        return $media ? $media->url : $default;
    }

    /**
     * Check if model has media in a collection.
     */
    public function hasMedia($collectionName = 'default')
    {
        return $this->media()->inCollection($collectionName)->exists();
    }
}
