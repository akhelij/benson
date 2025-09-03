<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
        'actual_delivery_date'
    ];

    protected $casts = [
        'livraison' => 'date',
        'actual_delivery_date' => 'date',
        'is_urgent' => 'boolean',
        'total_amount' => 'decimal:2',
        'total_quantity' => 'integer',
    ];

    /**
     * Get the order lines for the order.
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * Calculate and update total amount and quantity
     */
    public function recalculateTotals()
    {
        $totalAmount = 0;
        $totalQuantity = 0;

        foreach ($this->orderLines as $line) {
            $lineQuantity = 0;
            foreach (OrderLine::SIZE_COLUMNS as $column) {
                $lineQuantity += $line->{$column} ?? 0;
            }
            $totalQuantity += $lineQuantity;
            $totalAmount += $lineQuantity * ($line->prix ?? 0);
        }

        $this->total_amount = $totalAmount;
        $this->total_quantity = $totalQuantity;
        
        return $this;
    }

    /**
     * Calculate total price of the order (without updating)
     */
    public function calculateTotalAmount()
    {
        return $this->orderLines->sum(function($line) {
            $quantity = 0;
            foreach (OrderLine::SIZE_COLUMNS as $column) {
                $quantity += $line->{$column} ?? 0;
            }
            return $quantity * ($line->prix ?? 0);
        });
    }

    /**
     * Calculate total quantity of the order (without updating)
     */
    public function calculateTotalQuantity()
    {
        return $this->orderLines->sum(function($line) {
            $total = 0;
            foreach (OrderLine::SIZE_COLUMNS as $column) {
                $total += $line->{$column} ?? 0;
            }
            return $total;
        });
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
     * Scope for urgent orders
     */
    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    /**
     * Get delivered quantity
     */
    public function getDeliveredQuantityAttribute()
    {
        return $this->orderLines->where('livre', true)->sum(function($line) {
            $total = 0;
            foreach (OrderLine::SIZE_COLUMNS as $column) {
                $total += $line->{$column} ?? 0;
            }
            return $total;
        });
    }

    /**
     * Check if order is overdue
     */
    public function getIsOverdueAttribute()
    {
        return $this->livraison && 
               $this->livraison->isPast() && 
               !in_array($this->status, ['delivered', 'cancelled']);
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            'draft' => 'Brouillon',
            'confirmed' => 'Confirmée',
            'in_production' => 'En Production',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
        ];
        
        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get status color class
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'draft' => 'bg-stone-100 text-stone-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'in_production' => 'bg-amber-100 text-amber-800',
            'delivered' => 'bg-emerald-100 text-emerald-800',
            'cancelled' => 'bg-red-100 text-red-800',
        ];
        
        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}