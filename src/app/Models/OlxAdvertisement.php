<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OlxAdvertisement extends Model
{
    use HasFactory;

    protected $with = ["images"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany {
        return $this->hasMany(ImageOlx::class,"add_id");
    }
}
