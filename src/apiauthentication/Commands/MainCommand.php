<?php

namespace bushart\apiauthentication\apiauthentication\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Artisan;

class MainCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new api authentication';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Resource';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return;
    }


    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->handleCommands();
        $this->info($this->type . ' created successfully.');
    }

    protected function handleCommands()
    {
        //Generate controller
        $controllerName = 'AuthenticationController';
        $this->call('api:controller', ['name' => $controllerName]);
        $requests = ['LoginRequest','RegisterRequest','OtpRequest','VerifyOtpRequest'];
        $this->call('api:model', ['name' => 'User']);
        $this->call('api:mail', ['name' => 'OtpMail']);
        $this->call('api:trait', ['name' => 'AuthenticationTrait']);
        foreach ($requests as $name) {
            //create requests
            $request = $name . 'Request';
            $this->call('api:request', ['name' => $request]);
        }

        $this->call('api:views', ['name' => 'OtpMail']);
        $this->call('create:route');

        //publish migration
        Artisan::call('vendor:publish', [
            '--tag' => 'migrations',
        ]);
    }
}
