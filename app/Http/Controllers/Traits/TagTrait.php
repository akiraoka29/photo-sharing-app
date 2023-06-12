<?php

namespace App\Http\Controllers\Traits;

use App\Models\Tag;

trait TagTrait
{
    public function showTags()
    {
        // Show All Tag
        $tags = Tag::limit(16)->get();

        return $tags;
    }
}