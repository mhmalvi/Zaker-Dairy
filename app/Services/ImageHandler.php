<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageHandler
{
    private $image,
        $name,
        $path,
        $width = 600,
        $height = null;

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setDimension($width, $height = null)
    {
        $this->width = $width;
        $this->height = $height;
        return $this;
    }

    public function noDimension()
    {
        $this->width = $this->height = null;
        return $this;
    }

    /**
     * retrive file extension from base64 string
     */
    private function getOriginalFileExtension($file)
    {
        $encodedImgString = explode(',', $file, 2)[1];
        $decodedImgString = base64_decode($encodedImgString);
        $info = getimagesizefromstring($decodedImgString);

        $ext = image_type_to_extension($info[2]);

        return $ext;
    }

    public function storeFromImageData()
    {
        $extension = $this->getOriginalFileExtension($this->image);
        if (!$this->name) {
            throw new \Exception("ImageHandler::name is required for saving the image!");
        }
        $filename = "{$this->name}{$extension}";

        if (!Storage::exists('public/' . $this->path)) {
            Storage::makeDirectory('public/' . $this->path);
        }

        $image = Image::make($this->image);
        if ($this->width != null && $this->height != null) {
            $image->fit($this->width, $this->height);
        }
        $image->save(storage_path('app/public/' . $this->path . '/' . $filename));

        return $filename;
    }
}
