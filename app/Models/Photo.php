<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'caption',
        'file_path',
    ];

    protected $dates = ['deleted_at']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
