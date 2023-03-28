<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    // public function films(): HasMany 
    // { 
    //     return $this->hasMany(Film::class); 
    // }

    public function films(): BelongsToMany 
    { 
        return $this->belongsToMany(Film::class); 
    }
}
