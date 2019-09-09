<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class DTOMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:dto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data transfer object (DTO)';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'DTO';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false) {
            return false;
        }
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('collection')) {
            return __DIR__ . '/stubs/collection.dto.stub';
        }

        return __DIR__ . '/stubs/dto.stub';
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     *
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = $this->replaceDataObject($stub, $name);

        return parent::replaceClass($stub, $name);
    }

    /**
     * Replace the collection base object name
     *
     * @param $stub
     * @param $name
     *
     * @return mixed
     */
    protected function replaceDataObject($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);
        $dataObject = preg_replace('/(?:Data)?Collection/', 'Data', $class);

        return str_replace('DummyDataObject', $dataObject, $stub);
    }


    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('module')) {
            $rootNamespace = sprintf("%s\Modules\%s",
                $rootNamespace,
                str_replace('/', '\\', $this->option('module'))
            );
        }

        return $rootNamespace . '\DTO';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', 'm', InputOption::VALUE_OPTIONAL, 'Generate a DTO inside a module'],
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a DTO collection'],
        ];
    }
}

