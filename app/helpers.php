<?php

use Illuminate\Http\UploadedFile;

if (!function_exists('image')) {
    /**
     * @param array $data
     * @param string $key
     * @param $path
     * @param \Closure $func
     * @return \Uploading\Image\UploadingImage|null
     */
    function image(array $data, $key, $path, Closure $func)
    {
        return resolve('upload')->createImage($data, $key, $path, $func);
    }
}
if (!function_exists('multipleImage')) {
    /**
     * @param array $data
     * @param string $key
     * @param $path
     * @param \Closure $func
     * @return \Uploading\Image\UploadingImage|null
     */
    function multipleImage(array &$data, $key, $path, Closure $func)
    {
        return resolve('upload')->createMultipleImages($data, $key, $path, $func);
    }
}
if (!function_exists('uploading')) {
    function uploading(UploadedFile &$file, $path, Closure $func = null)
    {
        resolve('matrix.image')
            ->upload($file, $path, $func);

    }
}
if (!function_exists('uploadingResolver')) {
    /**
     * @return \Matrix\Image\ImageFacade
     */
    function uploadingResolver()
    {
        return resolve('matrix.image');
    }
}
if (!function_exists('translate')) {
    function translate($word)
    {
        return resolve('localization.repo')->findByWord($word);
    }
}
if (!function_exists('translateModel')) {
    function translateModel($model, $field)
    {
        return resolve('localization.model')->translate($model, $field);
    }
}