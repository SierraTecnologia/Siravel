<?php

namespace SiInteractions\Actions\Worker\Explorer\QueryList;

use QueryList\QueryList;

class Mapping
{
    public $url = false;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function execute($follow = true)
    {
        $ql = QueryList::get($this->url);

        $title = $ql->find('title')->text(); //The page title
        $keywords = $ql->find('meta[name=keywords]')->content; //The page keywords

        // Loop all the images
        $ql->find('a')->map(function($a){
            dd();
            echo $a->alt;  //Print the alt attribute of the image

        });
        $ql->find('form')->map(function($form){
            dd();
            echo $form->alt;  //Print the alt attribute of the image
            $form->find('input')->map(function ($formItem){

            });
        });
    }

}