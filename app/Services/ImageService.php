<?php

namespace App\Services;

class ImageService
{
    public static function upload($image)
    {
        $name = time().rand(1, 1000).'.'.$image->extension();
        $image->move(public_path('images'), $name);
        return $name;
    }
}
