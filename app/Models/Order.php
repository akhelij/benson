<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'firm',
        'ville',
        'telephone',
        'livraison',
        'transporteur',
        'boite',
        'logo',
        'logo1',
        'notes',
        'transort',
        'status',
        'total_amount',
        'currency',
        'total_quantity',
        'is_urgent',
    ];

    protected $casts = [
        'livraison' => 'date',
        'is_urgent' => 'boolean',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the order lines for the order.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * Calculate total price of the order
     */
    public function calculateTotalAmount()
    {
        return $this->orderLines->sum(function($line) {
            $quantity = $line->p5 + $line->p5x + $line->p6 + $line->p6x + 
                       $line->p7 + $line->p7x + $line->p8 + $line->p8x + 
                       $line->p9 + $line->p9x + $line->p10 + $line->p10x + 
                       $line->p11 + $line->p11x + $line->p12 + $line->p13;
            return $quantity * $line->prix;
        });
    }

    /**
     * Calculate total quantity of the order
     */
    public function calculateTotalQuantity()
    {
        $total = 0;
        foreach ($this->orderLines as $line) {
            $total += $line->p5 + $line->p5x + $line->p6 + $line->p6x + 
                     $line->p7 + $line->p7x + $line->p8 + $line->p8x + 
                     $line->p9 + $line->p9x + $line->p10 + $line->p10x + 
                     $line->p11 + $line->p11x + $line->p12 + $line->p13;
        }
        return $total;
    }

    /**
     * Scope for pending orders
     */
    public function scopePending($query)
    {
        return $query->whereIn('status', ['draft', 'confirmed', 'in_production']);
    }

    /**
     * Scope for delivered orders
     */
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    /**
     * Get delivered quantity
     */
    public function getDeliveredQuantityAttribute()
    {
        return $this->orderLines->where('livre', true)->sum(function($line) {
            return $line->p5 + $line->p5x + $line->p6 + $line->p6x + 
                   $line->p7 + $line->p7x + $line->p8 + $line->p8x + 
                   $line->p9 + $line->p9x + $line->p10 + $line->p10x + 
                   $line->p11 + $line->p11x + $line->p12 + $line->p13;
        });
    }
}
