<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoTag extends Model
{
    use HasFactory;

    protected $table = 'photo_tag';

    protected $fillable = [
        'photo_id',
        'tag_id',
    ];
}
