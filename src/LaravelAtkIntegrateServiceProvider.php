<?php

namespace Gowrav\LaravelAtkIntegrate;

use Illuminate\Support\ServiceProvider;

class LaravelAtkIntegrateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Boot logic here
    }

    public function register()
    {
        $this->app->singleton(
			'atkDb',
			function ($app) {
                $host = config('database.connections.mysql.host');
                $port = config('database.connections.mysql.port');
                $database = config('database.connections.mysql.database');

                $dsn = "mysql:host={$host};port={$port};dbname={$database}";

                $username = config('database.connections.mysql.username');
                $password = config('database.connections.mysql.password');

                $db = new \Atk4\Data\Persistence\Sql($dsn, $username, $password);
				return $db;
			}
		);
    }
}
