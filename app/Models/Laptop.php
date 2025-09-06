<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Laptop extends Model
{
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'description',
        'image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
