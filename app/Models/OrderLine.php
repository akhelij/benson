<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLine extends Model
{
    use HasFactory, SoftDeletes;

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
        'p5', 'p5x', 'p6', 'p6x', 'p7', 'p7x', 'p8', 'p8x',
        'p9', 'p9x', 'p10', 'p10x', 'p11', 'p11x', 'p12', 'p13',
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
        // Size fields should be integers
        'p5' => 'integer',
        'p5x' => 'integer',
        'p6' => 'integer',
        'p6x' => 'integer',
        'p7' => 'integer',
        'p7x' => 'integer',
        'p8' => 'integer',
        'p8x' => 'integer',
        'p9' => 'integer',
        'p9x' => 'integer',
        'p10' => 'integer',
        'p10x' => 'integer',
        'p11' => 'integer',
        'p11x' => 'integer',
        'p12' => 'integer',
        'p13' => 'integer',
    ];

    /**
     * Get the order that owns the order line.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Calculate total quantity for this line
     */
    public function getTotalQuantityAttribute()
    {
        return $this->p5 + $this->p5x + $this->p6 + $this->p6x + 
               $this->p7 + $this->p7x + $this->p8 + $this->p8x + 
               $this->p9 + $this->p9x + $this->p10 + $this->p10x + 
               $this->p11 + $this->p11x + $this->p12 + $this->p13;
    }

    /**
     * Get all size columns as array
     */
    public function getSizesAttribute()
    {
        return [
            'p5' => $this->p5,
            'p5x' => $this->p5x,
            'p6' => $this->p6,
            'p6x' => $this->p6x,
            'p7' => $this->p7,
            'p7x' => $this->p7x,
            'p8' => $this->p8,
            'p8x' => $this->p8x,
            'p9' => $this->p9,
            'p9x' => $this->p9x,
            'p10' => $this->p10,
            'p10x' => $this->p10x,
            'p11' => $this->p11,
            'p11x' => $this->p11x,
            'p12' => $this->p12,
            'p13' => $this->p13,
        ];
    }
}
