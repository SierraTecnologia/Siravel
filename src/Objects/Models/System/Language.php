<?php

namespace App\Models\System;

use Illuminate\Support\Facades\URL;

use App\Models\Traits\EloquentGetTableNameTrait;

class Language extends \RicardoSierra\Translation\Models\Language
{

    use EloquentGetTableNameTrait;
	
	public function getImageUrl( $withBaseUrl = false )
	{
		if(!$this->icon) return NULL;
		
		$imgDir = '/images/languages/' . $this->id;
		$url = $imgDir . '/' . $this->icon;
		
		return $withBaseUrl ? URL::asset( $url ) : $url;
	}
}