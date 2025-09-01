<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construction extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
