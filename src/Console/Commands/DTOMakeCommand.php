<?php

namespace GeTracker\SpatieGenerators\Console\Commands;

use GeTracker\SpatieGenerators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class DTOMakeCommand extends GeneratorCommand
{
    protected $name = 'make:dto';

    protected $description = 'Create a new data transfer object (DTO)';

    protected $type = 'DTO';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('collection')
            ? __DIR__ . '/stubs/collection.dto.stub'
            : __DIR__ . '/stubs/dto.stub';
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
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);
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
        return $this->getDomainNamespace($rootNamespace) . '\DTO';
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
            ['domain', 'd', InputOption::VALUE_OPTIONAL, 'Generate a DTO inside a domain'],
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a DTO collection'],
        ];
    }
}

