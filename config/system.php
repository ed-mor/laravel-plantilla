<?php

return [

    // Nombre de la aplicación
    'app_name' => env('APP_NAME') ?: 'Plantilla Systems',
    // Slogan de la AplicaAción
    'app_slogan' => env('APP_SLOGAN') ?: 'Los Generos del pensamiento',
    // Descripcción de la Aplicación
    'app_description' => env('APP_DESCRIPTION') ?: 'Plantilla Láravel 8, Jetstream(Inertia) y Tailwind',
    // Imagen Inicio Sesión
    'app_img_login' => env('APP_IMG_LOGIN') ? : '',
        // Super Admin (id del usuario que es SUPER ADMINISTRADOR)
    'super_admin' => env('APP_SUPER_ADMIN') ?: 1,
    // Ícono de la página
    'app_icon' => env('APP_ICON') ?: '/images/favicon.ico',
    // Logo de la aplicación env('APP_URL', 'Logo en el:') . env('APP_LOGO', '.env')
    'app_logo' => env('APP_LOGO') ?: 'logo de la aplicación',  
    // Avatar por defecto de los Usuarios
    'app_default_avatar' => env('APP_URL') . '/images/profile_default.jpeg',
    'app_isDemo' => false,


    // Admin Credentials (Credenciales del administrador)
    'admin_name' => env('ADMIN_NAME') ?: 'ed-mor',
    'admin_email' => env('ADMIN_EMAIL') ?: 'edserjmorenod@gmail.com',
    'admin_password' => env('ADMIN_PASSWORD') ?: 'Berta-77',

    // Article Page  (Comportamiento al renderizar artículos de un blog)
    'article' => [
        'title'       => 'Nothing is impossible.',
        'description' => 'https://pigjian.com',
        'number'      => 15,
        'sort'        => 'desc',
        'sortColumn'  => 'published_at',
    ],

    // Discussion Page (Para las características iniciales de las discusiones)
    'discussion' => [
        'number' => 20,
        'sort'   => 'desc',
        'sortColumn' => 'created_at',
    ],

    // Footer (Características del pie de página)
    'footer' => [
        'github' => [
            'open' => true,
            'url'  => 'https://ed-mor.github.io',
        ],
        'twitter' => [
            'open' => true,
            'url'  => 'https://twitter.com'
        ],
        'meta' => 'Systemas. Desarrollado por Edser Moreno',
    ],

    'license' => 'Licencia',

];
