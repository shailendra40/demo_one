<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageConveter extends Model
{
    use HasFactory;
    public static function convertImages($images, $path)
    {


        $convertedImages = [];

        foreach ($images as $image) {
            $fileName = uniqid() . '.webp';
            $imagePath = $path . $fileName;

            $directory = public_path($path);

            // Create the directory if it doesn't exist
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0755, true, true);
            }

            $convertedImagePath = ImageConverter::convertImage($image, $imagePath);

            if ($convertedImagePath) {
                array_push($convertedImages, $convertedImagePath);
            }
        }

        return $convertedImages;
    }
}
