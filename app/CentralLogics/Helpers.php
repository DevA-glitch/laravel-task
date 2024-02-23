<?php

namespace App\CentralLogics;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class Helpers
{
    /**
     * upload
     * @param dir
     * @param format
     * @param image
     * @return imageName
     */
    public static function upload(string $dir, string $format, $image = null)
    {
        

           if ($image != null) {

            $imageName = strtotime(Carbon::now()) . uniqid() . "." . $format;
            if (!Storage::disk('public_uploads')->exists($dir)) {
                Storage::disk('public_uploads')->makeDirectory($dir);
            }
            Storage::disk('public_uploads')->put($dir . $imageName, file_get_contents($image));
            return $imageName;
        }
    }

    /**
     * update
     *
     */
    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if ($image == null) {
            return $old_image;
        }
        if (Storage::disk('public_uploads')->exists($dir . $old_image)) {
            Storage::disk('public_uploads')->delete($dir . $old_image);
        }
        $imageName = Helpers::upload($dir, $format, $image);
        return $imageName;
    }

           /**
     * delete
     *
     */
    public static function delete(string $dir, $old_image)
    {
        if (Storage::disk('public_uploads')->exists($dir . $old_image)) {
            Storage::disk('public_uploads')->delete($dir . $old_image);
        }
        return true;
    }

    /**
     * module_permission_check
     * @param mod_name
     * @return bollean
     */
    public static function module_permission_check($mod_name)
    {
        return true;
    }
}
