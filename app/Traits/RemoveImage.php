<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait RemoveImage
{
    /**
     * check category logo if exist remove it
     *
    */
    public function RemoveLogoIfExist($object)
    {
        $localPath  =   explode("storage/", $object->image);
        if(Storage::disk('public')->exists($localPath[1])) {
            Storage::disk('public')->delete($localPath[1]);
        }
    }  

}