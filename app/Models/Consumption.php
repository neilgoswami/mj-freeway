<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'drink_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
}
