<?php

return [

    'models' => [
        // 'comments' => \App\Models\Comment::class,
        // 'categorys' => \App\Models\Category::class,
        // 'weapons' => \Informate\Models\Entytys\Fisicos\Weapon::class,
        // 'users' => \App\Models\User::class,

        // Identity
        'persons' => \Informate\Models\Identity\Actors\Person::class,
        'accounts' => \Informate\Models\Identity\Digital\Account::class,
        'passwords' => \Informate\Models\Identity\Password::class,
        'phones' => \Informate\Models\Identity\Phone::class,
        'dominios' => \Informate\Models\Entytys\Digital\Infra\Domain::class,
        'emails' => \Informate\Models\Identity\Email::class,
        'bibliotecas' => \Informate\Models\Market\Informacao\Biblioteca::class,
        'biblioteca_types' => \Informate\Models\Entytys\Category\BibliotecaType::class,

        // Hability
        'acessorios' => \Informate\Models\Entytys\Fisicos\Acessorio::class,
        'equipaments' => \Informate\Models\Entytys\Fisicos\Equipament::class,
        'genders' => \Informate\Models\Entytys\Fisicos\Gender::class,
        'gostos' => \Informate\Models\Entytys\Fisicos\Gosto::class,
        'infos' => \Informate\Models\Market\Abouts\Info::class,
        'integrations' => \Informate\Models\Entytys\Fisicos\Integration::class,
        'items' => \Informate\Models\Entytys\Fisicos\Item::class,
        'pintinhas' => \Informate\Models\Identity\Fisicos\Pintinha::class,
        'pincirgs' => \Informate\Models\Identity\Fisicos\Pircing::class,
        'positions' => \Informate\Models\Entytys\Relations\Position::class,
        'relations' => \Informate\Models\Entytys\Fisicos\Relation::class,
        'skills' => \Informate\Models\Entytys\Fisicos\Skill::class,
        'sitios' => \Informate\Models\Identity\Digital\Sitio::class,
        'tatuages' => \Informate\Models\Identity\Fisicos\Tatuage::class,

        // Internet
        'urls' => \Informate\Models\Entytys\Digital\Internet\Url::class,
        'url_links' => \Informate\Models\Entytys\Digital\Internet\UrlLink::class,

        // Midias
        'files' => \Finder\Models\Entytys\Digital\Midia\File::class,
        'images' => \Finder\Models\Entytys\Digital\Midia\Image::class,
        'photos' => \Finder\Models\Entytys\Digital\Midia\Photo::class,
        'photo_albums' => \Finder\Models\Entytys\Digital\Midia\PhotoAlbum::class,
        'thumbnails' => \Finder\Models\Entytys\Digital\Midia\Thumbnail::class,
        'videos' => \Finder\Models\Entytys\Digital\Midia\Video::class,


        // Components
        'productions' => \Informate\Models\Components\Productions\Production::class,
        'scene' => \Informate\Models\Components\Productions\Scene::class,
    ],

];

