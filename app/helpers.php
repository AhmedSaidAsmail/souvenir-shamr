<?php
if (!function_exists('image')) {
    /**
     * @param array $data
     * @param string $key
     * @param $path
     * @param \Closure $func
     * @return \Uploading\Image\UploadingImage|null
     */
    function image(array $data, $key, $path, \Closure $func)
    {
        return resolve('upload')->createImage($data, $key, $path, $func);
    }
}