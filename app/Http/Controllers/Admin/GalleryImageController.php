<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use App\Traits\UploadAble;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    use UploadAble;
    /**
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $gallery = Gallery::findOrFail($request->gallery_id);
        if ($request->has('image')) {
            $image = $this->uploadOne($request->image, 'gallery');
            $galleryImage = new Image([
                'url' => $image,
            ]);

            $gallery->images()->save($galleryImage);
        }
        return response()->json(['status' => 'success']);
    }

    public function delete(Request $request, Image $image)
    {
        $image = Image::findOrFail($image->id);
        if ($image->url != '') {
            $this->deleteOne($image->url);
        }
        $image->delete();

        return redirect()->back();
    }
}
