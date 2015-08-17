# Freguesias

Freguesias is a Laravel 5 package that provides all administrative regions in Portugal: distritos, concelhos and freguesias.

## Instalation

Add `horizontes/freguesias` to `composer.json`.

    "horizontes/freguesias": "dev-master"
    
Run `composer update` to pull down the latest version of Country List.

Edit `app/config/app.php` and add the `provider` and `filter`

    'providers' => [
        'Horizontes\Freguesias\FreguesiasServiceProvider',
    ]

Now add the alias.

    'aliases' => [
        'Freguesias' => 'Horizontes\Freguesias\FreguesiasFacade',
    ]
