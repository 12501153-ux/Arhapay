<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Saving extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'icon',
        'balance',
        'target',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'target' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}