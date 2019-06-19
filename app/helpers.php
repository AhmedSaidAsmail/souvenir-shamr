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
if (!function_exists('currency')) {
    function currency()
    {
        return "usd";
    }
}
if (!function_exists('overAllRating')) {
    function overAllRating(\App\Models\Product $product)
    {
        if ($count = $product->ratings()->count()) {
            return $product->ratings()->sum('ratings.rate') / $count;
        }
        return 0;
    }
}
if (!function_exists('overAllRatingPercentage')) {
    function overAllRatingPercentage(\App\Models\Product $product)
    {
        $rate = overAllRating($product);
        if ($rate) {
            $rate = (round($rate * 2) / 2) / 5 * 100;
        }
        return $rate;

    }
}
if (!function_exists('inputIsChecked')) {
    function inputIsChecked(\Illuminate\Http\Request $request, $name, $val)
    {
        if ($request->has($name)) {
            $values = $request->get($name);
            if (is_array($values) && in_array($val, $values)) {
                return "checked";
            }
            if ($values == $val) {
                return "checked";
            }
        }
        return null;
    }
}
if (!function_exists('cart')) {
    /**
     * @return \App\Src\Cart\ShoppingCart
     */
    function cart()
    {
        return app()->make('cart');
    }
}