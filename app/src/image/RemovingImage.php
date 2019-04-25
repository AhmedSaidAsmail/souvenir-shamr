<?php

namespace Matrix\Image;


class RemovingImage
{
    /**
     * @var Image
     */
    private $wrapper;
    /**
     * @var string $current_image Current image name
     */
    private $current_image;
    /**
     * @var array $thumbs
     */
    private $thumbs;

    /**
     * RemovingImage constructor.
     * @param Image $wrapper
     * @param $image
     * @param array $thumbs
     */
    public function __construct(Image $wrapper, $image, $thumbs = [])
    {
        $this->wrapper = $wrapper;
        $this->current_image = $image;
        $this->thumbs = $thumbs;
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
        return file_exists($this->currentImage()) && is_file($this->currentImage());
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
        //array_keys($this->wrapper->thumbs)
        foreach ($this->thumbs as $path) {
            $thumb = $path . $this->current_image;
            if (file_exists($thumb)) {
                unlink($thumb);
            }
        }
    }

}