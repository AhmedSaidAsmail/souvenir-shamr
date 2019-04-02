<?php

namespace Matrix\Image;

use Intervention\Image\Facades\Image as ImageFacades;

class Thumb
{
    /**
     * @var Image $wrapper
     */
    private $wrapper;
    /**
     * @var string $path Thumb path
     */
    private $path;
    /**
     * @var integer $width path width
     */
    private $width;

    /**
     * Thumb constructor.
     * @param Image $wrapper
     * @param $path
     * @param $width
     */
    public function __construct(Image $wrapper, $path, $width)
    {
        $this->wrapper = $wrapper;
        $this->path = $path;
        $this->width = $width;
    }

    /**
     * Making new image thumb
     *
     * @return \Intervention\Image\Image
     */
    private function makeThumb()
    {
        return ImageFacades::make($this->wrapper->file->getRealPath())
            ->resize($this->width, null, function ($ratio) {
                $ratio->aspectRatio();
            });
    }

    /**
     * Adding new image thumb to thumb listing
     *
     * @return Image
     */
    public function addThumb()
    {
        $this->wrapper->thumbs[$this->path] = $this->makeThumb();
        return $this->wrapper;
    }

}