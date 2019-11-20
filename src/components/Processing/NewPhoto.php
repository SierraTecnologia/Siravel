<?php

namespace SiInteractions\Processing;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class NewPhoto
{
    
    public function __construct()
    {
        
    }

    public function actions()
    {
        use psp\FaceDetector;
        $facedetect = new FaceDetector();
        $facedetect->faceDetect($_FILES['image']['tmp_name']);
        // $json = $facedetect->toJson();
        // echo $json;
        $facedetect->toJpeg();
    }

}
