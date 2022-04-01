<?php
namespace App\Services;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class CustomMediaUrlGenerator extends DefaultUrlGenerator {
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(): string
    {
        return storage_path('app'.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."{$this->media->id}".DIRECTORY_SEPARATOR."{$this->media->file_name}");
    }
}
