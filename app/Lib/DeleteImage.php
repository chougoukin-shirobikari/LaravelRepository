<?php

namespace App\Lib;

use App\Image;

Class DeleteImage
{
    public static function deleteImageByPostingId($posting_id)
    {
        $image = Image::where('posting_id', $posting_id);
        $image_name = $image->value('image_name');
        $image_path = public_path('images/'. $image_name);
        if(file_exists($image_path)){
            unlink($image_path);
            $image->delete();
        }
    }

    public static function deleteImageByThreadId($thread_id)
    {
        $imageList = Image::where('thread_id', $thread_id)->get();
        if(count($imageList) > 0){
            foreach($imageList as $image){
                $image_name = $image->image_name;
                $image_path = public_path('images/'. $image_name);
                if(file_exists($image_path)){
                    unlink($image_path);
                    $image->delete();
                }
            }
        }
    }

    public static function deleteImageByGenreId($genre_id)
    {
        $imageList = Image::where('genre_id', $genre_id)->get();
        if(count($imageList) > 0){
            foreach($imageList as $image){
                $image_name = $image->image_name;
                $image_path = public_path('images/'. $image_name);
                if(file_exists($image_path)){
                    unlink($image_path);
                    $image->delete();
                }
            }
        }
    }
}
