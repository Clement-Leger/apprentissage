<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['title', 'year', 'description'];

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function categories(): MorphToMany
    {
        return $this->morphedByMany(Category::class, 'filmable');
    }

    public function actors(): MorphToMany
    {
        return $this->morphedByMany(Actor::class, 'filmable');
    }
}
