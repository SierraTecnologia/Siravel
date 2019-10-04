<?php

namespace SiInteractions\Processing;

use App\Board;

use Illuminate\Support\Facades\Log;
use App\Models\User;

class GetNewData
{

    public function __construct(Board $board)
    {
        
    }

    
    
    public function run()
    {
        $this->forIntegrations();
    }
    
    public function forIntegrations()
    {
        $selfClass = $this;
        $this->board->executeForEachIntegration(
            function ($integration) use ($selfClass) {
                $selfClass->forComponents($integration);
            }
        );
    }
    
    
    public function forComponents($integration)
    {
        $selfClass = $this;
        $this->board->executeForEachComponent(
            function ($component, $callback) use ($integration) {
                $data = $integration->getNewDataForComponent($component);
                foreach($data as $result) {
                    $callback($result);
                }
            }
        );
    }

}
