<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ProductImages
{
    public array $resizeableImages = [];
    public function storeImages(array $images): self
    {
        foreach ($images as $index => $image) {
            $this->addMedia($image['image'])->toMediaCollection('products'); // store new image
            if (!empty($image['width']) && !empty($image['height'])) {
                $this->resizeableImages[] = ['index' => $index, 'width' => $image['width'], 'height' => $image['height']];
            }
        }
        return $this;
    }

    public function resize() :void
    {
        $productPhotos = $this->getMedia('products');
        foreach ($this->resizeableImages as $resizeableImage) {
            Image::make($productPhotos[$resizeableImage['index']]->getPath())
                ->resize($resizeableImage['width'], $resizeableImage['height'])
                ->save($productPhotos[$resizeableImage['index']]->getPath());
        }
    }
}
