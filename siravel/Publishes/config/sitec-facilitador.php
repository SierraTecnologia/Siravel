<?php

return [

    'models' => [
        // 'comments' => \App\Models\Comment::class,
        // 'categorys' => \App\Models\Category::class,
        // 'weapons' => \App\Models\Weapon::class,
        // 'users' => \App\Models\User::class,

        // Identity
        'persons' => \Siravel\Models\Identity\Person::class,
        'accounts' => \Siravel\Models\Identity\Account::class,
        'passwords' => \Siravel\Models\Identity\Password::class,
        'phones' => \Siravel\Models\Identity\Phone::class,
        'dominios' => \Siravel\Models\Identity\Dominio::class,
        'emails' => \Siravel\Models\Identity\Email::class,
        'bibliotecas' => \Siravel\Models\Identity\Biblioteca::class,
        'biblioteca_types' => \Siravel\Models\Identity\BibliotecaType::class,

        // Hability
        'acessorios' => \Siravel\Models\Identity\Hability\Acessorio::class,
        'equipaments' => \Siravel\Models\Identity\Hability\Equipament::class,
        'genders' => \Siravel\Models\Identity\Hability\Gender::class,
        'gostos' => \Siravel\Models\Identity\Hability\Gosto::class,
        'infos' => \Siravel\Models\Identity\Hability\Info::class,
        'integrations' => \Siravel\Models\Identity\Hability\Integration::class,
        'items' => \Siravel\Models\Identity\Hability\Item::class,
        'pintinhas' => \Siravel\Models\Identity\Hability\Pintinha::class,
        'pincirgs' => \Siravel\Models\Identity\Hability\Pircing::class,
        'positions' => \Siravel\Models\Identity\Hability\Position::class,
        'relations' => \Siravel\Models\Identity\Hability\Relation::class,
        'skills' => \Siravel\Models\Identity\Hability\Skill::class,
        'sitios' => \Siravel\Models\Identity\Hability\Sitio::class,
        'tatuages' => \Siravel\Models\Identity\Hability\Tatuage::class,

        // Internet
        'urls' => \Siravel\Models\Digital\Internet\Url::class,
        'url_links' => \Siravel\Models\Digital\Internet\UrlLink::class,

        // Midias
        'files' => \Siravel\Models\Digital\Midia\File::class,
        'images' => \Siravel\Models\Digital\Midia\Image::class,
        'photos' => \Siravel\Models\Digital\Midia\Photo::class,
        'photo_albums' => \Siravel\Models\Digital\Midia\PhotoAlbum::class,
        'thumbnails' => \Siravel\Models\Digital\Midia\Thunbnail::class,
        'videos' => \Siravel\Models\Digital\Midia\Video::class,


        // Components
        'productions' => \Siravel\Models\Components\Productions\Production::class,
        'scene' => \Siravel\Models\Components\Productions\Scene::class,
    ],

];

