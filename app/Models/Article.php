<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'nom',
        'description',
    ];

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
