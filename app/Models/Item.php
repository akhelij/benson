<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMedia;

class Item extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'nom',
        'code',
        'description',
        'price',
        'type',
        'parent_id'
    ];

    /**
     * Get the parent item.
     */
    public function parent()
    {
        return $this->belongsTo(Item::class, 'parent_id');
    }

    /**
     * Get the children items.
     */
    public function children()
    {
        return $this->hasMany(Item::class, 'parent_id');
    }

    /**
     * Scope a query to only include items of a given type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get items by type
     */
    public static function getByType($type)
    {
        return static::where('type', $type)->get();
    }

    /**
     * Get formes (shoe forms)
     */
    public static function getFormes()
    {
        return static::where('type', 'forme')->get();
    }

    /**
     * Get articles for a specific forme
     */
    public static function getArticlesForForme($formeId)
    {
        return static::where('type', 'article')
                    ->where('parent_id', $formeId)
                    ->get();
    }

    /**
     * Get all cuirs (leathers)
     */
    public static function getCuirs()
    {
        return static::where('type', 'cuir')->get();
    }

    /**
     * Get all semelles (soles)
     */
    public static function getSemelles()
    {
        return static::where('type', 'semelle')->get();
    }

    /**
     * Get all constructions
     */
    public static function getConstructions()
    {
        return static::where('type', 'construction')->get();
    }

    /**
     * Get all supplements
     */
    public static function getSupplements()
    {
        return static::where('type', 'supplement')->get();
    }
}
