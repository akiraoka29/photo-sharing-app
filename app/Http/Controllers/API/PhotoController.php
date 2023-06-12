<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Traits\PhotoTrait;
use App\Http\Request\FormPhotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Enum\Message;
use App\Helper\Helper;

use DB;

class PhotoController extends ApiController
{
    use PhotoTrait;

    public function __construct()
    {
        $this->helper = new Helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Get Photos
            $photos = $this->showPhotos();
            
            return $this->sendResponse(200, 'Get photo success.', $photos);
        } catch(Exception $e) {
            return $this->sendException($e);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPhotoRequest $request)
    {
        try {
            // Make sure the user is logged in
            if(!Auth::check()) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }
            $user = Auth::user();

            if(!$request->tags) return $this->sendResponse(400, Message::TAG_REQUIRED);
            
            if($request->hasFile('image')) {
                DB::beginTransaction();
                $image = $request->file('image');
                $filePath = "user-$user->id";
                // Save Image in Storage
                $uploadStorage = $this->uploadStorage($image,$filePath);

                // Set Data
                $photo = new \StdClass;
                $photo->user_id = $user->id;
                $photo->title = $request->title;
                $photo->caption = $request->caption;
                $photo->file_name = $uploadStorage['fileName'];
                $photo->file_path = $filePath;
                $photo->tags = $request->tags;

                $this->createPhoto($user,$photo);

                $response = [
                    'code' => 200,
                    'message' => 'Upload photo success.'
                ];
                DB::commit();
            }else {
                $response = [
                    'code' => 400,
                    'message' => Message::NOT_IMAGE
                ];
            }
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
            DB::rollback();
            return $this->sendException($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Find Photo
            $photo = $this->findPhoto($id);
            if($photo) {
                $response = [
                    'code' => 200,
                    'message' => 'Show photo success.'
                ];
            }else {
                $response = [
                    'code' => 404,
                    'message' => Message::NOT_FOUND
                ];
            }
            return $this->sendResponse($response['code'], $response['message'], $photo);
            
        } catch(Exception $e) {
            return $this->sendException($e);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\FormPhotoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormPhotoRequest $request, $id)
    {
        try {
            // Find Photo by Id
            $photo = $this->findPhoto($id);

            // Make sure the user is logged in
            if(!Auth::check()) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }
            $user = Auth::user();

            if($photo && $photo->user_id === $user->id) {
                DB::beginTransaction();
                if($request->hasFile('image')) {
                    $image = $request->file('image');
                    $filePath = "user-$user->id";
                    $hasFile = true;
                    // Save Image in Storage
                    $uploadStorage = $this->uploadStorage($image,$filePath);
                }else {
                    $hasFile = false;
                }
                
                // Set Data
                $form = new \StdClass;
                $form->user_id = $user->id;
                $form->title = $request->title;
                $form->caption = $request->caption;
                $form->file_name = ($hasFile == true) ? $uploadStorage['fileName'] : $photo->file_name;
                $form->file_path = ($hasFile == true) ? $filePath : $photo->file_path;
                $form->tags = $request->tags;
                
                $this->editPhoto($user,$photo,$form);

                $response = [
                    'code' => 200,
                    'message' => 'Update photo success.'
                ];
                DB::commit();
            }else {
                $response = [
                    'code' => 404,
                    'message' => Message::NOT_FOUND
                ];
            }
            
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
            DB::rollback();
            return $this->sendException($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Find Photo by ID
            $photo = $this->findPhoto($id);

            // Make sure the user is logged in
            if(!Auth::check()) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }
            $user = Auth::user();

            // Delete Photo by ID
            if($photo) {
                if($photo->user_id === $user->id) {
                    $photo->delete();

                    $response = [
                        'code' => 200,
                        'message' => 'Delete photo success.'
                    ];
                }else {
                    $response = [
                        'code' => 403,
                        'message' => Message::FORBIDDEN
                    ];
                }
            }else {
                $response = [
                    'code' => 404,
                    'message' => Message::NOT_FOUND
                ];
            }
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
            return $this->sendException($e);
        }
    }

    /**
     * Like photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like(Request $request, $id)
    {
        try {
            // Find Photo by ID
            $photo = $this->findPhoto($id);

            // Make sure the user is logged in
            if(!Auth::check()) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }
            $user = Auth::user();
            
            if($photo) {
                // Check if the user has liked before
                if(!$user->likes()->where('photo_id', $photo->id)->exists()) {
                    $photo->likes()->create([
                        'user_id' => $user->id
                    ]);
                }

                $response = [
                    'code' => 200,
                    'message' => 'Photo liked'
                ];
            }else {
                $response = [
                    'code' => 400,
                    'message' => 'Failed to like the photo'
                ];
            }
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
            return $this->sendException($e);
        }
    }

    /**
     * Unlike photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlike(Request $request, $id)
    {
        try {
            // Find Photo by ID
            $photo = $this->findPhoto($id);

            // Make sure the user is logged in
            if(!Auth::check()) {
                return $this->sendResponse(401, Message::UNAUTHORIZED);
            }
            $user = Auth::user();
            
            if($photo) {
                // Check if the user has liked before
                if($user->likes()->where('photo_id', $photo->id)->exists()) {
                    // Delete liked photo
                    $photo->likes()->delete();
                }

                $response = [
                    'code' => 200,
                    'message' => 'Photo unliked'
                ];
            }else {
                $response = [
                    'code' => 400,
                    'message' => 'Failed to ulike the photo'
                ];
            }
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
            return $this->sendException($e);
        }
    }
}
