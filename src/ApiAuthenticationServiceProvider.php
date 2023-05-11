<?php

namespace bushart\apiauthentication;
use Illuminate\Support\ServiceProvider;

class ApiAuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->commands([
            apiauthentication\Commands\MainCommand::class,
            apiauthentication\Commands\ControllerCommand::class,
            apiauthentication\Commands\RequestCommand::class,
            apiauthentication\Commands\MailCommand::class,
            apiauthentication\Commands\ViewCommand::class,
            apiauthentication\Commands\ModelCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/migration/022_11_24_110854_create_users_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_users_table.php'),
        ], 'migrations');


    }
}
