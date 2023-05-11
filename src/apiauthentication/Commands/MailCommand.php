<?php

namespace bushart\apiauthentication\apiauthentication\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MailCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:mail {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Otp Authentication mail';

    protected $type = 'Mail';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Mail';
    }

    protected function buildClass($name)
    {
        $controllerNamespace = '';

        $replace["use {$controllerNamespace}\Controller;\n"] = '';
        $replace = array_merge($replace, [
            'DummyViewPath' => '',
            'DummyServiceVar' => '',
            'DummySingularServiceVar' => '',
            'DummyContract' => '',
            'DummyModel' => '',
        ]);

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->laravel->version() >= 10){
            return __DIR__ . '/../../resources/stubs/mail/otp-mail.stub';
        }else if($this->laravel->version() >= 9){
            return __DIR__ . '/../../resources/stubs/mail/otp-mail-old.stub';
        }else{
            return __DIR__ . '/../../resources/stubs/mail/otp-mail-version.stub';
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->comment('Building new mail');

        $name = $this->qualifyClass($this->getNameInput());
        $path = $this->getPath($name);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type . ' created successfully.');
    }
}
