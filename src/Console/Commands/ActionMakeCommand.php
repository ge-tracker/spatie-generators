<?php

namespace GeTracker\SpatieGenerators\Console\Commands;

use GeTracker\SpatieGenerators\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ActionMakeCommand extends GeneratorCommand
{
    protected $name = 'make:action';

    protected $description = 'Create a new action class';

    protected $type = 'Action';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('sync')
            ? __DIR__ . '/stubs/action.sync.stub'
            : __DIR__ . '/stubs/action.stub';
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
        return $this->getDomainNamespace($rootNamespace) . '\Actions';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', 'm', InputOption::VALUE_OPTIONAL, 'Generate an action inside a module'],
            ['domain', 'd', InputOption::VALUE_OPTIONAL, 'Generate an action inside a domain'],
            ['sync', null, InputOption::VALUE_NONE, 'Indicates that action should be synchronous'],
        ];
    }
}

