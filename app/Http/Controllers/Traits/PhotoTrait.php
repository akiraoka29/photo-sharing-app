<?php

namespace App\Http\Controllers\Traits;

use App\Models\Photo;
use App\Models\PhotoTag;

trait PhotoTrait
{
    public function showPhotos()
    {
        // Show All Photo
        $photos = Photo::with('tags')->limit(9)->get();

        return $photos;
    }

    public function findPhoto($id)
    {
        // Show Photo Detail
        $photo = Photo::with(['tags' => function($q) {
            $q->select('tags.id','name');
        }])->find($id);

        return $photo;
    }
   
    public function editPhoto($model,$data)
    {

        return $model->update([
            'title' => $data->title,
            'caption' => $data->caption
        ]);
    }
}