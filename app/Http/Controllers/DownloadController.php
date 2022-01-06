<?php

namespace App\Http\Controllers;

use App\Image;

class DownloadController extends Controller
{
    //アップロードされた画像のパスを取得する
    public function returnImagePath($posting_id)
    {
        $image = Image::where('posting_id', $posting_id)->first();
        $image_name = $image->image_name;
        return '/images/' . $image_name;
    }

}
