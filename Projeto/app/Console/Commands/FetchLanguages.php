<?php
//Utilizar este comando composer dump-autoload primeiro para nao da raia
//Usar este comando php artisan fetch:languages para ir buscar as linguas á Fluent
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\API\APIFluentMeController;

class FetchLanguages extends Command
{
    protected $signature = 'fetch:languages';
    protected $description = 'Fetch and store languages';

    public function handle()
    {
        // Instancia o controlador
        $fluentMeController = new APIFluentMeController();

        // Chama a função para ir buscar e armazenar as linguagens
        $fluentMeController->fetchAndStoreLanguages();

        $this->info('Languages fetched and stored successfully.');
    }
}