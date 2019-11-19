<?php

return [

    'models' => [
        // 'comments' => \App\Models\Comment::class,
        // 'categorys' => \App\Models\Category::class,
        // 'weapons' => \App\Models\Weapon::class,
        // 'users' => \App\Models\User::class,

        // Identity
        'persons' => \Siravel\Models\Identity\Actors\Person::class,
        'accounts' => \Siravel\Models\Identity\Account::class,
        'passwords' => \Siravel\Models\Identity\Password::class,
        'phones' => \Siravel\Models\Identity\Phone::class,
        'dominios' => \Siravel\Models\Entytys\Digital\Infra\Domain::class,
        'emails' => \Siravel\Models\Identity\Email::class,
        'bibliotecas' => \Siravel\Models\Identity\Biblioteca::class,
        'biblioteca_types' => \Siravel\Models\Entytys\Category\BibliotecaType::class,

        // Hability
        'acessorios' => \Siravel\Models\Entytys\Fisicos\Acessorio::class,
        'equipaments' => \Siravel\Models\Entytys\Fisicos\Equipament::class,
        'genders' => \Siravel\Models\Entytys\Fisicos\Gender::class,
        'gostos' => \Siravel\Models\Entytys\Fisicos\Gosto::class,
        'infos' => \Siravel\Models\Entytys\Fisicos\Info::class,
        'integrations' => \Siravel\Models\Entytys\Fisicos\Integration::class,
        'items' => \Siravel\Models\Entytys\Fisicos\Item::class,
        'pintinhas' => \Siravel\Models\Entytys\Fisicos\Pintinha::class,
        'pincirgs' => \Siravel\Models\Entytys\Fisicos\Pircing::class,
        'positions' => \Siravel\Models\Entytys\Fisicos\Position::class,
        'relations' => \Siravel\Models\Entytys\Fisicos\Relation::class,
        'skills' => \Siravel\Models\Entytys\Fisicos\Skill::class,
        'sitios' => \Siravel\Models\Entytys\Fisicos\Sitio::class,
        'tatuages' => \Siravel\Models\Entytys\Fisicos\Tatuage::class,

        // Internet
        'urls' => \Siravel\Models\Entytys\Digital\Internet\Url::class,
        'url_links' => \Siravel\Models\Entytys\Digital\Internet\UrlLink::class,

        // Midias
        'files' => \Siravel\Models\Entytys\Digital\Midia\File::class,
        'images' => \Siravel\Models\Entytys\Digital\Midia\Image::class,
        'photos' => \Siravel\Models\Entytys\Digital\Midia\Photo::class,
        'photo_albums' => \Siravel\Models\Entytys\Digital\Midia\PhotoAlbum::class,
        'thumbnails' => \Siravel\Models\Entytys\Digital\Midia\Thumbnail::class,
        'videos' => \Siravel\Models\Entytys\Digital\Midia\Video::class,


        // Components
        'productions' => \Siravel\Models\Components\Productions\Production::class,
        'scene' => \Siravel\Models\Components\Productions\Scene::class,
    ],

];

