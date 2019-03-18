<?php

namespace Uploading\Image;


class RemovingImage
{
    /**
     * @var UploadingImage
     */
    private $wrapper;
    /**
     * @var string $current_image Current image name
     */
    private $current_image;

    /**
     * RemovingImage constructor.
     * @param UploadingImage $wrapper
     * @param $image
     */
    public function __construct(UploadingImage $wrapper, $image)
    {
        $this->wrapper = $wrapper;
        $this->current_image = $image;
    }

    /**
     * Removing current image and thumbs if exists
     *
     */

    public function remove()
    {
        if ($this->currentIsExists()) {
            unlink($this->currentImage());
            $this->removeThumbs();
        }
    }

    /**
     * Define if current image is exists
     *
     * @return bool
     */

    private function currentIsExists()
    {
        return file_exists($this->currentImage());
    }

    /**
     * Full current image path
     *
     * @return string
     */
    private function currentImage()
    {
        return $this->wrapper->path . $this->current_image;
    }

    /**
     * Removing current image thumbs
     *
     */

    protected function removeThumbs()
    {
        foreach (array_keys($this->wrapper->thumbs) as $path) {
            $thumb = $path . $this->current_image;
            if (file_exists($thumb)) {
                unlink($thumb);
            }
        }
    }

}