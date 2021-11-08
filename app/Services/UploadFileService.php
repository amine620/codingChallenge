<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService{


    function takeFilePath($fileName,$folderName)
    {
        return
            Storage::putFileAs(
            $folderName,
            $fileName,
            random_int(1, 100) . '.' .$fileName->guessExtension()
        );
    }
}