<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flavor extends Model
{
    use HasFactory;

    public function drinks() : HasMany
    {
        return $this->hasMany(Drink::class);
    }
}
