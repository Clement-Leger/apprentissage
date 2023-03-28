<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    use HasFactory;

    // public function films(): HasMany 
    // { 
    //     return $this->hasMany(Film::class); 
    // }

    protected $fillable = ['name', 'slug'];

    public function films(): MorphToMany 
    { 
        // return $this->belongsToMany(Film::class); 
        return $this->morphToMany(Film::class, 'filmable');
    }
}
