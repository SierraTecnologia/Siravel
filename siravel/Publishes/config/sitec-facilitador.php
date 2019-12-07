<?php

return [

    'models' => [
        // 'comments' => \App\Models\Comment::class,
        // 'categorys' => \App\Models\Category::class,
        // 'weapons' => \Informate\Models\Entytys\Fisicos\Weapon::class,
        // 'users' => \App\Models\User::class,

        // Identity
        'persons' => \Population\Models\Identity\Actors\Person::class,
        'accounts' => \Population\Models\Identity\Digital\Account::class,
        'passwords' => \Population\Models\Identity\Digital\Password::class,
        'phones' => \Population\Models\Identity\Phone::class,
        'dominios' => \Informate\Models\Entytys\Digital\Infra\Domain::class,
        'emails' => \Population\Models\Identity\Email::class,
        'bibliotecas' => \Population\Models\Market\Informacao\Biblioteca::class,
        'biblioteca_types' => \Informate\Models\Entytys\Category\BibliotecaType::class,

        // Hability
        'acessorios' => \Informate\Models\Entytys\Fisicos\Acessorio::class,
        'equipaments' => \Informate\Models\Entytys\Fisicos\Equipament::class,
        'genders' => \Informate\Models\Entytys\Fisicos\Gender::class,
        'gostos' => \Informate\Models\Entytys\About\Gosto::class,
        'infos' => \Population\Models\Market\Abouts\Info::class,
        'integrations' => \Informate\Models\Entytys\Fisicos\Integration::class,
        'items' => \Informate\Models\Entytys\Fisicos\Item::class,
        'pintinhas' => \Population\Models\Identity\Fisicos\Pintinha::class,
        'pincirgs' => \Population\Models\Identity\Fisicos\Pircing::class,
        'positions' => \Informate\Models\Entytys\Relations\Position::class,
        'relations' => \Informate\Models\Entytys\Fisicos\Relation::class,
        'skills' => \Informate\Models\Entytys\Fisicos\Skill::class,
        'sitios' => \Population\Models\Identity\Digital\Sitio::class,
        'tatuages' => \Population\Models\Identity\Fisicos\Tatuage::class,

        // Internet
        'urls' => \Informate\Models\Entytys\Digital\Internet\Url::class,
        'url_links' => \Informate\Models\Entytys\Digital\Internet\UrlLink::class,

        // Midias
        'files' => \Informate\Models\Entytys\Digital\Midia\File::class,
        'images' => \Informate\Models\Entytys\Digital\Midia\Image::class,
        'photos' => \Informate\Models\Entytys\Digital\Midia\Photo::class,
        'photo_albums' => \Informate\Models\Entytys\Digital\Midia\PhotoAlbum::class,
        'thumbnails' => \Informate\Models\Entytys\Digital\Midia\Thumbnail::class,
        'videos' => \Informate\Models\Entytys\Digital\Midia\Video::class,


        // Components
        'productions' => \Informate\Models\Components\Productions\Production::class,
        'scene' => \Informate\Models\Components\Productions\Scene::class,
    ],

];

