<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait Uploadable {

    /**
     * Upload a single file in the server
     *
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file, $folder = null, $filename = null, $disk = 'public')
    {
        $name = ! is_null($filename) ? $filename : str_random(25);

        return $file->storeAs(
            $folder,
            $name . '.' . $file->getClientOriginalExtension(),
            $disk
        );
    }
}
