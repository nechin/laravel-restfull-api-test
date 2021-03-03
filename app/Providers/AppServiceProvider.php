<?php

namespace App\Providers;

use App\Entities\Customer;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\CustomerRepository;
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
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new CustomerRepository(
                $app['em'],
                $app['em']->getClassMetaData(Customer::class)
            );
        });
    }
}
