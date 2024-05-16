<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drink extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function ingredients() : HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function flavor() : BelongsTo
    {
        return $this->belongsTo(Flavor::class);
    }
}
