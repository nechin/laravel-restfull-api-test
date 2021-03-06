<?php

namespace App\Providers;

use App\Entities\Customer;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\CustomerRepository;
use App\Services\DataImporter\Contracts\Importer;
use App\Services\DataImporter\DataImporter;
use App\Services\DataProvider\BaseProvider;
use Exception;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepository::class, function($app) {
            return new CustomerRepository(
                $app['em'],
                $app['em']->getClassMetaData(Customer::class)
            );
        });

        $this->app->bind(Importer::class, DataImporter::class);

        $this->app->bind(BaseProvider::class, function ($app) {
            $class = config('services.provider');
            if (empty($class)) {
                throw new Exception('Wrong provider class name');
            }

            return new $class();
        });
    }
}
