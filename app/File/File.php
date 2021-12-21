<?php 


namespace App\File;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait File {

    public $public_path = "/public/uploads/";
    public $storage_path = "/storage/uploads/";

    public function image($file,$path,$width,$height)
    {
       if ( $file ) {

           $extension       = $file->getClientOriginalExtension();
           $file_name       = $path.'-'.Str::random(30).'.'.$extension;
           $url             = $file->storeAs($this->public_path,$file_name);
           $public_path     = public_path($this->storage_path.$file_name);
           $img             = Image::make($public_path)->resize($width, $height);
           $url             = preg_replace( "/public/", "storage", $url );
           return $img->save($public_path) ? $url : '';
       }
    }

    public function file( $file, $path )
    {
        if ( $file ) {
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs($path, $fileName, 'public');
            return $path;
        }
    }
}