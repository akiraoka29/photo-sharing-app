<?php

namespace App\Http\Controllers\Traits;

use App\Models\Photo;
use App\Models\PhotoTag;

use App\Enum\Date;

use Carbon\Carbon;

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
        }, 'likes'])->find($id);

        return $photo;
    }

    public function uploadStorage($image,$filePath)
    {
        $extension = $image->getClientOriginalExtension();
        $fileName = $this->helper->fileNameFormat($extension);
        // Save Image in Storage
        $saveImage = $image->storeAs($filePath,$fileName,'public');

        return [
            'fileName' => $fileName,
            'extension' => $extension
        ];
    }
   
    public function createPhoto($user,$data)
    {
        $photo = new Photo;
        $photo->user_id = $data->user_id;
        $photo->title = $data->title;
        $photo->caption = $data->caption;
        $photo->file_name = $data->file_name;
        $photo->file_path = $data->file_path;
        $photo->created_at = Carbon::now(Date::TIMEZONE);

        $user->photos()->save($photo);
        
        // Insert Photo Tag
        $this->insertPhotoTag($data->tags, $photo);

        return $photo;
    }

    public function editPhoto($user,$model,$data)
    {
        $photo = $model->update([
            'title' => $data->title,
            'caption' => $data->caption,
            'file_name' => $data->file_name,
            'file_path' => $data->file_path,
            'updated_at' => Carbon::now(Date::TIMEZONE)
        ]);
        // Remove Photo Tag
        $this->resetPhotoTag($model);
        // Insert Photo Tag
        if($data->tags) $this->insertPhotoTag($data->tags, $model);
    }

    public function insertPhotoTag($tag,$photo)
    {
        foreach ($tag as $tagId) {
            // Check Tag ID is Double or Not
            if(!$photo->tags()->where('tag_id', $tagId)->exists()) $photo->tags()->attach($tagId);
        }
    }

    public function resetPhotoTag($photo)
    {
        $photo->tags()->detach();
    }
}