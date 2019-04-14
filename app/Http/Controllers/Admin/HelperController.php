<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperController extends Controller
{
    public static $IMAGE_ID = 1;
    public function uploadImage()
    {
        $image = request()->file('image');
        $folder_name = random_int(10, 99);
        $subfolder_name = random_int(10, 99);

//        $image_extention = strtolower($image->getClientOriginalExtension());

        $image_url = "/storage/images/$folder_name/$subfolder_name/".$image->getClientOriginalName();

        $path = $image->storeAs(
            "public/images/$folder_name/$subfolder_name", $image->getClientOriginalName());

        return [
            'error' => false,
            'url' => $image_url,
        ];
    }
}
