# Freguesias

Freguesias is a Laravel 5 package that provides all administrative regions in Portugal: distritos, concelhos and freguesias.

## Instalation

Add `horizontes/freguesias` to `composer.json`.

    "horizontes/freguesias": "dev-master"
    
Run `composer update` to pull down the latest version of Country List.

Edit `config/app.php` and add the `provider` and `filter`

    'providers' => [
        'Horizontes\Freguesias\FreguesiasServiceProvider',
    ]

Now add the alias.

    'aliases' => [
        'Freguesias' => 'Horizontes\Freguesias\FreguesiasFacade',
    ]

## Publishing

Optionaly you can publishing the configuration if you want to change the default table name `freguesias`:

    $ php artisan vendor:publish

To generate the migration file use:

    $ php artisan freguesias:migration
    
This will generate the `<timestamp>_setup_freguesias_table.php` migration and the `FreguesiasSeeder.php` seeder. To make sure the data is seeded insert the following code in the `seeds/DatabaseSeeder.php`

    //Seed the countries
    $this->call('FreguesiasSeeder');
    $this->command->info('Seeded the freguesias!'); 

You may now run the seeder and fill the `freguesias` table with the artisan migrate command:

    $ php artisan migrate --seed
    
