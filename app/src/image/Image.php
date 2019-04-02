<?php

namespace Matrix\Image;

use Illuminate\Http\UploadedFile;
use Matrix\Image\Exceptions\InvalidPathException;
use Closure;

/**
 * Class Image
 * @package Matrix\Image
 * @method Image current(string $current)
 */
class Image
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
     * @var string $name The new image name
     */
    public $name;
    /**
     * @var \Intervention\Image\Image[] $thumbs Listing of image thumbs
     */
    public $thumbs = [];
    /**
     * @var string|null $current Current image name
     */
    private $current = null;

    /**
     * UploadingImage constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param UploadedFile $file
     * @param $path
     */
    private function setAttributes(UploadedFile $file, $path)
    {
        $this->file = $file;
        $this->path = $this->pathResolver($path);
        $this->setName();
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
     * Generating random and unique name for image
     *
     */
    private function setName()
    {
        $this->name = md5(uniqid(mt_rand())) . "." . $this->file->getClientOriginalExtension();
    }

    public function thumb($width, $path = 'thumb')
    {
        $path = $this->thumbPath($path);
        if ($this->pathIsTrueDir($path)) {
            return (new Thumb($this, $path, $width))->addThumb();
        }
        throw new InvalidPathException(sprintf('Dir:%s is not exists', $path));
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

    /**
     * Saving thumb in their associated dirs
     *
     * @return $this
     */
    protected function saveThumbs()
    {
        array_walk($this->thumbs, function (&$thumb, $path) {
            $thumb->save($path . $this->name);
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
     * Moving image to the path
     *
     * @return $this
     */
    private function save()
    {
        $this->file->move($this->path, $this->name);
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
            (new RemovingImage($this, $this->current, array_keys($this->thumbs)))->remove();
        }
        return $this;
    }

    /**
     * Uploading image and thumbs and delete current if exists
     *
     * @param UploadedFile $file
     * @param $path
     * @param Closure|null $func
     */
    public function upload(UploadedFile &$file, $path, Closure $func = null)
    {
        $this->setAttributes($file, $path);
        if (!is_null($func)) {
            $func($this);
        }
        $this->make();
        $file = $this->name;

    }

    /**
     * Uploading image and thumbs and delete current if exists
     *
     */
    private function make()
    {
        $this->saveThumbs()
            ->save()
            ->removeCurrent();
    }

    /**
     * Remove specified image
     *
     * @param $path
     * @param $image
     * @param array $thumbs
     */
    public function remove($path, $image, $thumbs = [])
    {
        $this->path = $this->pathResolver($path);
        array_walk($thumbs, function (&$thumb) {
            $thumb = $this->thumbPath($thumb);
        });
        (new RemovingImage($this, $image, $thumbs))->remove();

    }

    /**
     * Set mutator method
     *
     * @param $method
     * @param $arguments
     * @return mixed
     */
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