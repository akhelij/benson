<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLine extends Model
{
    use HasFactory, SoftDeletes;

    // Define all size columns consistently
    const SIZE_COLUMNS = [
        'p5', 'p5x', 'p6', 'p6x', 'p7', 'p7x', 'p8', 'p8x',
        'p9', 'p9x', 'p10', 'p10x', 'p11', 'p11x', 'p12', 'p12x',
        'p13', 'p13x', 'p14', 'p14x', 'p15', 'p16', 'p17'
    ];

    protected $fillable = [
        'order_id',
        'article',
        'forme',
        'client',
        'semelle',
        'construction',
        'cuir',
        'doublure',
        'supplement',
        // Include all size columns
        'p5', 'p5x', 'p6', 'p6x', 'p7', 'p7x', 'p8', 'p8x',
        'p9', 'p9x', 'p10', 'p10x', 'p11', 'p11x', 'p12', 'p12x',
        'p13', 'p13x', 'p14', 'p14x', 'p15', 'p16', 'p17',
        'prix',
        'devise',
        'talon',
        'finition',
        'lacet',
        'lacetx',
        'perforation',
        'fleur',
        'image',
        'langue',
        'genre',
        'livre',
        'pointure',
        'vpointure',
        'trepointe',
        'trepointe_img',
        'dentlage'
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'lacetx' => 'decimal:2',
        'fleur' => 'integer',
        'livre' => 'integer',
        'perforation' => 'integer',
        'dentlage' => 'integer',
        // Cast all size fields as integers
        'p5' => 'integer', 'p5x' => 'integer',
        'p6' => 'integer', 'p6x' => 'integer',
        'p7' => 'integer', 'p7x' => 'integer',
        'p8' => 'integer', 'p8x' => 'integer',
        'p9' => 'integer', 'p9x' => 'integer',
        'p10' => 'integer', 'p10x' => 'integer',
        'p11' => 'integer', 'p11x' => 'integer',
        'p12' => 'integer', 'p12x' => 'integer',
        'p13' => 'integer', 'p13x' => 'integer',
        'p14' => 'integer', 'p14x' => 'integer',
        'p15' => 'integer', 'p16' => 'integer', 'p17' => 'integer',
    ];

    /**
     * Get the order that owns the order line.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the forme item
     */
    public function formeItem()
    {
        return $this->belongsTo(Item::class, 'forme')->where('type', 'forme');
    }

    /**
     * Get the article item
     */
    public function articleItem()
    {
        return $this->belongsTo(Item::class, 'article')->where('type', 'article');
    }

    /**
     * Get the semelle item
     */
    public function semelleItem()
    {
        return $this->belongsTo(Item::class, 'semelle')->where('type', 'semelle');
    }

    /**
     * Get the construction item
     */
    public function constructionItem()
    {
        return $this->belongsTo(Item::class, 'construction')->where('type', 'construction');
    }

    /**
     * Get the cuir item
     */
    public function cuirItem()
    {
        return $this->belongsTo(Item::class, 'cuir')->where('type', 'cuir');
    }

    /**
     * Get the doublure item
     */
    public function doublureItem()
    {
        return $this->belongsTo(Item::class, 'doublure')->where('type', 'doublure');
    }

    public function supplementItem()
    {
        return $this->belongsTo(Item::class, 'supplement')->where('type', 'supplement');
    }

    /**
     * Calculate total quantity for this line
     */
    public function getTotalQuantityAttribute()
    {
        $total = 0;
        foreach (self::SIZE_COLUMNS as $column) {
            $total += $this->{$column} ?? 0;
        }
        return $total;
    }

    /**
     * Get total amount for this line
     */
    public function getTotalAmountAttribute()
    {
        return $this->total_quantity * ($this->prix ?? 0);
    }

    /**
     * Get all size columns as array
     */
    public function getSizesAttribute()
    {
        $sizes = [];
        foreach (self::SIZE_COLUMNS as $column) {
            $sizes[$column] = $this->{$column} ?? 0;
        }
        return $sizes;
    }

    /**
     * Get sizes with quantities greater than zero
     */
    public function getActiveSizesAttribute()
    {
        $activeSizes = [];
        foreach (self::SIZE_COLUMNS as $column) {
            if ($this->{$column} > 0) {
                $activeSizes[$column] = $this->{$column};
            }
        }
        return $activeSizes;
    }

    /**
     * Set all size quantities from array
     */
    public function setSizesFromArray(array $sizes)
    {
        foreach (self::SIZE_COLUMNS as $column) {
            $this->{$column} = $sizes[$column] ?? 0;
        }
    }
}