<?php

namespace SiInteractions\Actions\Instagram;

use Siravel\Models\Actions\Calendar\AcaoHumana;
use Illuminate\Support\Facades\Facade;
use Log;
use Siravel\Models\Entytys\Digital\Midia\Image;

class GetMidias extends Instagram
{

    /**
     * InstagramScraper\Model\Media^ {#1880                                                                                                                                                             
  #id: "2135313304562151772"                                                                                                                                                                     
  #shortCode: "B2iKCMal7Fc"                                                                                                                                                                      
  #createdTime: 1568769203                                                                                                                                                                       
  #type: "image"                                                                                                                                                                                 
  #link: "https://www.instagram.com/p/B2iKCMal7Fc"                                                                                                                                               
  #imageLowResolutionUrl: ""                                                                                                                                                                     
  #imageThumbnailUrl: "https://instagram.fsdu5-1.fna.fbcdn.net/vp/eb37d33f2a8f4f25a482b67545aa02e4/5E0069B4/t51.2885-15/sh0.08/e35/c104.0.872.872a/s640x640/69622802_489123121934811_532218828635
311624_n.jpg?_nc_ht=instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"                                                                                                                                 
  #imageStandardResolutionUrl: ""                                                                                                                                                                
  #imageHighResolutionUrl: "https://instagram.fsdu5-1.fna.fbcdn.net/vp/0a7eb909354d918f86ceb111457d97be/5DFC5457/t51.2885-15/e35/69622802_489123121934811_532218828635311624_n.jpg?_nc_ht=instagr
am.fsdu5-1.fna.fbcdn.net&_nc_cat=103"                                                                                                                                                            
  #squareImages: array:5 [                                                                                                                                                                       
    0 => "https://instagram.fsdu5-1.fna.fbcdn.net/vp/f7aa63bf3b20c904f628853286e49dab/5E355241/t51.2885-15/e35/c104.0.872.872a/s150x150/69622802_489123121934811_532218828635311624_n.jpg?_nc_ht=
instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"                                                                                                                                                     
    1 => "https://instagram.fsdu5-1.fna.fbcdn.net/vp/7165e380725ba865c6ed0025c79c9488/5E1A7FF4/t51.2885-15/e35/c104.0.872.872a/s240x240/69622802_489123121934811_532218828635311624_n.jpg?_nc_ht=
instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"                                                                                                                                                     
    2 => "https://instagram.fsdu5-1.fna.fbcdn.net/vp/d316aac4b62b50434e40d4e69e01b2e0/5E36DB4C/t51.2885-15/e35/c104.0.872.872a/s320x320/69622802_489123121934811_532218828635311624_n.jpg?_nc_ht=
instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"                                                                                                                                                     
    3 => "https://instagram.fsdu5-1.fna.fbcdn.net/vp/4ffdc13fb06336a4f0f69d7fe0a2f49a/5E3CAD10/t51.2885-15/e35/c104.0.872.872a/s480x480/69622802_489123121934811_532218828635311624_n.jpg?_nc_ht=
instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"
    4 => "https://instagram.fsdu5-1.fna.fbcdn.net/vp/eb37d33f2a8f4f25a482b67545aa02e4/5E0069B4/t51.2885-15/sh0.08/e35/c104.0.872.872a/s640x640/69622802_489123121934811_532218828635311624_n.jpg?
_nc_ht=instagram.fsdu5-1.fna.fbcdn.net&_nc_cat=103"
  ]
  #carouselMedia: []
  #caption: "Game over kkk #bjj #bjjgirls #jiujitsufeminino"
  #isCaptionEdited: false
  #isAd: false
  #videoLowResolutionUrl: ""
  #videoStandardResolutionUrl: 
     *
     * @param [type] $target
     * @return void
     */
    public function executeForEach($target)
    {
        collect($this->executor->getMedias($target, 25))->each(function ($media) use ($target) {
            $name = md5($media->getShortCode());
            // if ($media->getType()=='image') {
            //     Log::info('É imagem');
            // }


            if (!$acaoHumana = AcaoHumana::where([
                'fingerprint' => $name,
                ])->first()){
                    $acaoHumana = AcaoHumana::create([
                        'fingerprint' => $name,
                        'people_slug' => $target
                        ]);
            }
            Log::info($name);

            // $accountPost = $this->account->posts()->firstOrCreate(
            //     [
            //         'code' => $media->getId()
            //     ]
            // );
            // $acaoHumana->addInfo('caption', $media->getCommentsCount());
            $acaoHumana->addInfo('posted_at', $media->getCreatedTime());
            $acaoHumana->addStat('comments', $media->getCommentsCount());
            $acaoHumana->addStat('links', $media->getLikesCount());
            
            $i = Image::createByExternalLink(
                [
                    'name' => $name,
                    'fingerprint' => $name,
                    'external' => $media->getImageHighResolutionUrl(),
                ],
                $target
            );
            // Importar Imagem
            
        });
    }
}
