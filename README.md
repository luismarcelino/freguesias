# Freguesias

Freguesias is a Laravel 5 package that provides all administrative regions in Portugal: distritos, concelhos and freguesias.

## Instalation

Add `horizontes/freguesias` to `composer.json`.

    "horizontes/freguesias": "dev-master"

Run `composer update` to pull down the latest version of Country List.

Edit `config/app.php` and add the `provider` and `filter`

    'providers' => [
        Horizontes\Freguesias\FreguesiasServiceProvider::class,,
    ]

Now add the alias.

    'aliases' => [
        'Freguesias' => Horizontes\Freguesias\FreguesiasFacade::class,
    ]

## Publishing

Optionaly you can publishing the configuration if you want to change the default table name `freguesias`:

    $ php artisan vendor:publish

To generate the migration file use:

    $ php artisan freguesias:migration

This will generate the `<timestamp>_setup_freguesias_table.php` migration and the `FreguesiasSeeder.php` seeder. To run the migration, run as usual:

    php artisan migrate:refresh

To run just this seeder user the artisan command:

    php artisan db:seed --class=FreguesiasSeeder
