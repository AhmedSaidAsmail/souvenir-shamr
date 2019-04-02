        uploading($image, $path, function ($image) {
            $image->thumb($width)
                ->thumb($width,$thumb_path)
                ->current($current_name);
        });
        
        
        uploading($image, $path);
        
        
        uploadingResolver()
        ->model(Model $model)
        ->multipleUpload(array $attribute, $image_key, $path, function ($image) {
                    $image->thumb($width);
                });