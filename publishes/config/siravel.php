<?php
/**
 * Siravel Configuration
 */

return [

    /**
     * Business Ativo
     */
    // 'business' => Data\Negocios\Clients\CarolNovaes::class,
    'business' => Data\Negocios\Clients\RicaSolucoes::class,

    'influencia' => true,

    /**
     * Business Padrão
     */
    'default' =>  env('TENANCY_DEFAULT_HOSTNAME', 'ricasolucoes'),

    /**
     * Configurações Personalizadas
     */
    'can_register_free' => true,
    'terms' => 'Termos e condições para cadstro de usuários',

    /*
     * --------------------------------------------------------------------------
     * Features
     * --------------------------------------------------------------------------
    */

    'load-features' => true,
    'module-directory' => 'admin/features',
    'active-core-features' => [
        'blog',
        'menus',
        'files',
        'images',
        'pages',
        'widgets',
        'events',
        'faqs',
    ],

    /*
    |--------------------------------------------------------------------------
    | Features for Home
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'features' => \App\Logic\Features\FeatureBase::getFeatures(),

    /*
    |--------------------------------------------------------------------------
    | Actores
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'actores' => [
        'CEO', 'MARKETING'
    ],

    'groups' => [
        'FA',
        'HOUSE'
    ],

    /*
     * --------------------------------------------------------------------------
     * Front-end:
     * default
     * Themes Options
     * sierratecnologia
     * ricardosierra
     * snowevo
     * --------------------------------------------------------------------------
    */

    'frontend-namespace' => '\App\Http\Controllers\Admin',
    'frontend-theme' => 'default',

    
    /*
     * --------------------------------------------------------------------------
     * Admin management
     * --------------------------------------------------------------------------
    */
    'backend-title' => 'Siravel',
    'backend-route-prefix' => 'admin',
    'root-route-prefix' => 'root',
    'backend-theme' => 'adminlte', // cosmo, cyborg, flatly, lumen, paper, sandstone, simplex, united, yeti
    'registration-available' => false,
    'pagination' => 25,

    /*
     * --------------------------------------------------------------------------
     * Languages
     * --------------------------------------------------------------------------
    */

    'auto-translate' => true,

    'default-language' => 'pt-BR',

    'languages' => [
        'en' => 'english',
        'en-US' => 'english',
        'pt-BR' => 'portuguese',
        'fr' => 'french',
    ],


    /*
     * --------------------------------------------------------------------------
     * Analytics
     * --------------------------------------------------------------------------
    */

    'analytics' => 'internal',   // google, internal

    /*
     * --------------------------------------------------------------------------
     * Pixabay
     * --------------------------------------------------------------------------
    */

    'pixabay' => env('PIXABAY'),

    /*
     * --------------------------------------------------------------------------
     * Live preview in editor
     * --------------------------------------------------------------------------
    */

    'live-preview' => false,
    
    /*
     * --------------------------------------------------------------------------
     * RSS
     * --------------------------------------------------------------------------
    */

    'rss' => [
        'title' => '',
        'link' => '',
        'description' => '',
        'name' => '',
    ],

    /*
     * --------------------------------------------------------------------------
     * Site Mapped Modules
     * --------------------------------------------------------------------------
    */

    'site-mapped-modules' => [
        'blog' => 'Siravel\Repositories\BlogRepository',
        'page' => 'Siravel\Repositories\Negocios\PageRepository',
        'events' => 'Siravel\Repositories\EventRepository',
    ],


    /*
     * --------------------------------------------------------------------------
     * Images and File Storage
     * --------------------------------------------------------------------------
    */

    'storage-location' => 'local', // s3, local
    'max-file-upload-size' => 6291456, // 6MB
    'preview-image-size' => 800, // width - auto height
    'cloudfront' => null, // do not include http

    /**
     * Facilitador
     */
    'facilitador' => [
        'login' => true,
    ],

    /*
     * --------------------------------------------------------------------------
     * API key and token
     * --------------------------------------------------------------------------
    */

    'api-key' => env('GPOWER_API_KEY', 'apis-are-cool'),
    'api-token' => env('GPOWER_API_TOKEN', 'siravel-token'),

    /*
     * --------------------------------------------------------------------------
     * Core Module Forms
     * --------------------------------------------------------------------------
    */

    'forms' => [
        'blog' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
                'tags' => [
                    'type' => 'string',
                    'class' => 'tags',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'images' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
                'custom' => 'checked',
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
        ],

        'images-edit' => [
            'location' => [
                'type' => 'file',
                'alt_name' => 'File',
            ],
            'name' => [
                'type' => 'string',
            ],
            'alt_tag' => [
                'type' => 'string',
                'alt_name' => 'Alt Tag',
            ],
            'title_tag' => [
                'type' => 'string',
                'alt_name' => 'Title Tag',
            ],
            'tags' => [
                'type' => 'string',
                'class' => 'tags',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
        ],

        'page' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],

        'widget' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
            'content' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
        ],

        'faqs' => [
            'question' => [
                'type' => 'string',
            ],
            'answer' => [
                'type' => 'text',
                'class' => 'redactor',
            ],
            'is_published' => [
                'type' => 'checkbox',
                'alt_name' => 'Published',
            ],
            'published_at' => [
                'type' => 'string',
                'class' => 'datetimepicker',
                'alt_name' => 'Publish Date',
                'custom' => 'autocomplete="off"',
                'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
            ],
        ],

        'menu' => [
            'name' => [
                'type' => 'string',
            ],
            'slug' => [
                'type' => 'string',
            ],
        ],

        'link' => [
            'name' => [
                'type' => 'string',
            ],
            'external' => [
                'type' => 'checkbox',
                'custom' => 'value="1"',
            ],
            'external_url' => [
                'type' => 'string',
                'alt_name' => 'Url',
            ],
        ],

        'files' => [
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'file-edit' => [
            'name' => [],
            'is_published' => [
                'type' => 'checkbox',
                'value' => 1,
            ],
            'tags' => [
                'custom' => 'data-role="tagsinput"',
            ],
            'details' => [
                'type' => 'textarea',
            ],
        ],

        'event' => [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'start_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
                'end_date' => [
                    'type' => 'string',
                    'class' => 'datepicker',
                    'custom' => 'autocomplete="off"',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ],
        'promotion' => [
            'identity' => [
                'slug' => [
                    'type' => 'string',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Publish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
                'finished_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'custom' => 'autocomplete="off"',
                    'alt_name' => 'Finish Date',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
            'content' => [
                'details' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Details',
                ],
            ],
        ],
    ],
];
