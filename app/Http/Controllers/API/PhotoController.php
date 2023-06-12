<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Request\FormPhotoRequest;
use Illuminate\Http\Request;


use App\Http\Controllers\Traits\PhotoTrait;

class PhotoController extends ApiController
{
    use PhotoTrait;
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
    public function store(Request $request)
    {
        //
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
                    'message' => 'Data not found.'
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

            if($photo) {
                $this->editPhoto($photo,$request);

                $response = [
                    'code' => 200,
                    'message' => 'Update photo success.'
                ];
            }else {
                $response = [
                    'code' => 404,
                    'message' => 'Data not found.'
                ];
            }
            
            return $this->sendResponse($response['code'], $response['message']);
        } catch(Exception $e) {
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
            // Delete Photo by ID
            if($photo) {
                $photo->delete();
                return $this->sendResponse(200, 'Delete photo success.');
            }else {
                return $this->sendResponse(404, 'Data not found.');
            }
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

    }
}
