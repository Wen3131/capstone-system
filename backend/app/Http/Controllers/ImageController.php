<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller 
{
    public function compressImage(Request $request) 
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $image = $request->file['image'];
        /* 
            Note: Use $image = base64_decode($request['image'])
            if the image is sent as a base64 encoded image.
        */
        $image_name = time().'_'.$image->getClientOriginalName();
        $path = public_path('uploads/') . "/" . $image_name;

        Image::make($image->getRealPath())->resize(150, 150)->save($path);
      
        return response()->json(
            [
                'data' => 'Image compressed and added'
            ], 
            201
        );
    }
}
