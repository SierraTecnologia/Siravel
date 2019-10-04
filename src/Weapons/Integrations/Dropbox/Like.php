<?php

namespace App\Logic\Connections\Integrations\Dropbox;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Like extends Dropbox
{
    
    public function __construct()
    {
        
    }

    public function likeOtherComponent($component)
    {
        $result = $this->getConnection()->likeMedia($component->getReference());
        if ($result->meta->code === 200) {
          echo 'Success! The image was added to your likes.';
        } else {
          echo 'Something went wrong :(';
        }
    }


}
