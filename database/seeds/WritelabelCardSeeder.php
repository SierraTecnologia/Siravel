<?php

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\CardSlide;

class WritelabelCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $card = Card::create(
            [
            'title' => "{!! trans('snowevo.winter') !!} 2018",
            'description' => "{!! trans('snowevo.europe') !!}",
            'subtitle' => '',
            'price' => '',
            'subdescription' => '',
            'image' => 'img/media/2016/card1.png',
            'imagesTitle' => "Winter 2017 {!! trans('snowevo.europe') !!}",
            'text1' => "{!! trans('snowevo.andorra') !!}",
            'text2' => "{!! trans('snowevo.espanha') !!}",
            'text3' => "{!! trans('snowevo.franca') !!}",
            'text4' => "{!! trans('snowevo.pirineusEAlpes') !!}",
            'buttonName' => "{!! trans('snowevo.card_reserve') !!}",
            'buttonNewPage' => false,
            'buttonLink' => "#contact",
            ]
        );









        // $card = Card::create([
        //     'title' => "",
        //     'description' => "",
        //     'subtitle' => '',
        //     'price' => '',
        //     'subdescription' => '',
        //     'image' => 'img/media/2016/card10.png',
        //     'imagesTitle' => "Winter 2017 {!! trans('snowevo.europe') !!}",
        //     'text1' => "{!! trans('snowevo.andorra') !!}",
        //     'text2' => "{!! trans('snowevo.espanha') !!}",
        //     'text3' => "{!! trans('snowevo.franca') !!}",
        //     'text4' => "{!! trans('snowevo.pirineusEAlpes') !!}",
        //     'buttonName' => "{!! trans('snowevo.card_reserve') !!}",
        //     'buttonNewPage' => false,
        //     'buttonLink' => "#contact",
        // ]);
















        $card = Card::create(
            [
            'title' => "{!! trans('snowevo.winter') !!} 2018",
            'description' => "{!! trans('snowevo.europe') !!}",
            'subtitle' => '',
            'price' => '',
            'subdescription' => '',
            'image' => 'img/media/2016/card1.png',
            'imagesTitle' => "Winter 2017 {!! trans('snowevo.europe') !!}",
            'text1' => "{!! trans('snowevo.andorra') !!}",
            'text2' => "{!! trans('snowevo.espanha') !!}",
            'text3' => "{!! trans('snowevo.franca') !!}",
            'text4' => "{!! trans('snowevo.pirineusEAlpes') !!}",
            'buttonName' => "{!! trans('snowevo.card_reserve') !!}",
            'buttonNewPage' => false,
            'buttonLink' => "#contact",
            ]
        );

    }
}
