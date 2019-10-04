<?php
/**
 * Procura trampos
 */

namespace SiInteractions\Logic\Connections\Plugins\Processing\Stat;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class Pointable
{
    protected $referenceComponent;

    public function __construct()
    {
        
    }
    
    public function setComponent($component)
    {
        $this->component = $component;
        return $this;
    }
    
    public function setReferenceComponent($referenceComponent)
    {
        $this->referenceComponent = $referenceComponent;
    }

    public function run()
    {

    }
    
    public function profileToProfile()
    {
        // Get Points from Profile Fa

    }
    
    public function postToProfile(Post $post, Profile $profile)
    {
        return ($post->countLikes()*1)+($post->countComments()*3);
    }

}
