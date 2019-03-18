<?php

namespace Uploading\Image;

use Illuminate\Http\UploadedFile;

/**
 * Class UploadingImage
 * @package Uploading\Image
 * @method UploadingImage current(string $current)
 * @method UploadingImage target(string $target)
 */
class UploadingImage
{
    /**
     * @var UploadedFile $file
     */
    public $file;
    /**
     * @var string $path Uploading image destination
     */
    public $path;
    /**
     * @var string $image_name The new image name
     */
    public $image_name;
    /**
     * @var string|null $current Current image name
     */
    private $current = null;
    /**
     * @var \Intervention\Image\Image[] $thumbs Listing of image thumbs
     */
    public $thumbs = [];
    /**
     * @var string $target
     */
    private $target;

    /**
     * UploadingImage constructor.
     * @param UploadedFile $file
     * @param string $path
     * @param string|null $target
     */
    public function __construct(UploadedFile $file, $path, $target = null)
    {
        $this->file = $file;
        $this->path = $this->pathResolver($path);
        $this->target = $target;
        $this->setImageName();
    }

    /**
     * Setting resource path
     *
     * @param $path
     * @return string
     * @throws InvalidPathException
     */
    private function pathResolver($path)
    {
        $path = public_path() . DIRECTORY_SEPARATOR . $this->cleanPath($path) . DIRECTORY_SEPARATOR;
        if ($this->pathIsTrueDir($path)) {
            return $path;
        }
        throw new InvalidPathException(sprintf('Dir:%s is not exists', $this->path));
    }

    /**
     * Cleaning path from slashes and backlashes
     *
     * @param $pattern
     * @return string
     */
    private function cleanPath($pattern)
    {
        return trim(str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $pattern), DIRECTORY_SEPARATOR);
    }

    /**
     * Setting the full thumb path
     *
     * @param $path
     * @return string
     */
    private function thumbPath($path)
    {
        return $this->path . $this->cleanPath($path) . DIRECTORY_SEPARATOR;
    }

    private function setImageName()
    {
        $this->image_name = md5(uniqid(mt_rand())) . "." . $this->file->getClientOriginalExtension();
    }

    /**
     * Check is the path is already exists
     *
     * @param null $path
     * @return bool
     */
    private function pathIsTrueDir($path = null)
    {
        $path = is_null($path) ? $this->path : $path;
        return is_dir($path);
    }

    /**
     * Setting new image thumb
     *
     * @param $path
     * @param $width
     * @return UploadingImage
     * @throws InvalidPathException
     */
    public function thumb($path, $width)
    {
        $path = $this->thumbPath($path);
        if ($this->pathIsTrueDir($path)) {
            return (new Thumb($this, $path, $width))->addThumb();
        }
        throw new InvalidPathException(sprintf('Dir:%s is not exists', $this->path));

    }

    /**
     * Saving thumb in their associated dirs
     *
     * @return $this
     */
    protected function saveThumbs()
    {
        array_walk($this->thumbs, function (&$thumb, $path) {
            $thumb->save($path . $this->image_name);
        });
        return $this;
    }

    /**
     * Setting current image
     *
     * @param $current_image
     * @return $this
     */
    public function setCurrent($current_image)
    {
        $this->current = $current_image;
        return $this;
    }

    /**
     * Define current image is already set
     *
     * @return bool
     */

    private function currentIsSet()
    {
        return !is_null($this->current);
    }

    /**
     * Removing current image and thumbs
     *
     * @return $this
     */
    private function removeCurrent()
    {
        if ($this->currentIsSet()) {
            (new RemovingImage($this, $this->current))->remove();
        }
        return $this;
    }

    /**
     * Moving image to the path
     *
     * @return $this
     */
    private function save()
    {
        $this->file->move($this->path, $this->image_name);
        return $this;
    }

    /**
     * Setting Target key which will put the image name on it
     *
     * @param $target
     * @return $this
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;

    }

    /**
     * @param array|null $attributes
     * @return $this
     */
    public function upload(array &$attributes = null)
    {
        return $this->saveThumbs()
            ->save()
            ->removeCurrent()
            ->modifyTargetKey($attributes);
    }

    /**
     * Replacing target key with image name in the returning array if exists
     *
     * @param null $attributes
     * @return $this
     */
    private function modifyTargetKey(&$attributes = null)
    {
        if ($this->targetIsSet($attributes)) {
            $attributes[$this->target] = $this->image_name;
        }
        return $this;

    }

    /**
     * Define if target key is set
     *
     * @param null $attributes
     * @return bool
     */
    private function targetIsSet($attributes = null)
    {
        return !is_null($attributes) && is_array($attributes) && !is_null($this->target);
    }


    private function setMutator($method, $arguments)
    {
        return $this->{"set" . ucfirst($method)}(...$arguments);
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, "set" . ucfirst($method))) {
            return $this->setMutator($method, $arguments);
        }
    }

}