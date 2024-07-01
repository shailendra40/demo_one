<?php

namespace Intervention\Image\Drivers\Gd\Encoders;

use Intervention\Gif\Builder as GifBuilder;
use Intervention\Image\Drivers\DriverSpecializedEncoder;
use Intervention\Image\EncodedImage;
use Intervention\Image\Interfaces\ImageInterface;

class GifEncoder extends DriverSpecializedEncoder
{
    public function encode(ImageInterface $image): EncodedImage
    {
        if ($image->isAnimated()) {
            return $this->encodeAnimated($image);
        }

        $gd = $image->core()->native();
        $data = $this->getBuffered(function () use ($gd) {
            imagegif($gd);
        });

        return new EncodedImage($data, 'image/gif');
    }

    protected function encodeAnimated(ImageInterface $image): EncodedImage
    {
        $builder = GifBuilder::canvas(
            $image->width(),
            $image->height(),
            $image->loops()
        );

        foreach ($image as $frame) {
            $builder->addFrame(
                $this->encode($frame->toImage($image->driver())),
                $frame->delay()
            );
        }

        return new EncodedImage($builder->encode(), 'image/gif');
    }
}
