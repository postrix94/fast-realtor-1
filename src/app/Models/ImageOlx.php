<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOlx extends Model
{
    use HasFactory;

    protected $table = "images_olx";

    protected $fillable = [
        "link", "add_id"
    ];
}
