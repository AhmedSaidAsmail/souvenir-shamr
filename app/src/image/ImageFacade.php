<?php

namespace Matrix\Image;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Closure;

/**
 * Class ImageFacade
 * @package Matrix\Image
 * @method ImageFacade model(Model $model)
 */
class ImageFacade
{
    /**
     * @var Image $image
     */
    private $image;
    /**
     * @var Model $model ;
     */
    private $model;
    /**
     * @var string $primary_key Model primary key
     */
    private $primary_key = 'id';

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Set model for image array
     *
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Set the primary key for the model.
     *
     * @param  string $key
     * @return $this
     */
    public function setKeyName($key)
    {
        $this->primary_key = $key;
    }

    /**
     * Uploading single image file
     *
     * @param UploadedFile $file
     * @param $path
     * @param Closure|null $func
     */
    public function upload(UploadedFile &$file, $path, Closure $func = null)
    {
        $this->image->upload($file, $path, $func);
    }

    /**
     * Uploading multi image from array
     *
     * @param array $attributes
     * @param $key
     * @param $path
     * @param Closure|null $func
     */
    public function multipleUpload(array &$attributes, $key, $path, Closure $func = null)
    {
        array_walk($attributes, function (&$attribute) use ($key, $path, $func) {
            if (is_array($attribute) && array_key_exists($key, $attribute) && $attribute[$key] instanceof UploadedFile) {
                $instance = $this->newImageInstance();
                $this->setCurrentImage($instance, $attribute, $key);
                $instance->upload($attribute[$key], $path, $func);
            }
        });

    }

    /**
     * @return Image
     */
    private function newImageInstance()
    {
        return new Image();
    }

    /**
     * Set current image for image instance
     *
     * @param Image $image
     * @param array $attribute
     * @param $image_key
     */
    private function setCurrentImage(Image $image, array $attribute, $image_key)
    {
        if ($this->modelIsSet() && $this->attributeHasPrimaryKey($attribute)) {
            $image
                ->setCurrent($this->model->newModelQuery()->find($attribute[$this->primary_key])->{$image_key});
        }
    }

    /**
     * Define if Model is exists
     *
     * @return bool
     */
    protected function modelIsSet()
    {
        return !is_null($this->model);
    }

    /**
     * Define if attribute list has the primary key for model
     *
     * @param array $attribute
     * @return bool
     */
    protected function attributeHasPrimaryKey(array $attribute)
    {
        return array_key_exists($this->primary_key, $attribute);

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
        $this->image->remove($path, $image, $thumbs);
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