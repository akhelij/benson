<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'ville',
        'pays'
    ];

    /**
     * Get the orders for the client.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
