<?php

namespace GeTracker\SpatieGenerators;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;

abstract class GeneratorCommand extends BaseGeneratorCommand
{
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

        return $rootNamespace . '\Actions';
    }

    /**
     * Get the Module or Domain namespaced folder
     *
     * @param $rootNamespace
     *
     * @return string
     */
    protected function getDomainNamespace($rootNamespace)
    {
        if (is_null($this->option('domain')) && is_null($this->option('module'))) {
            return $rootNamespace;
        }

        if ($this->option('domain')) {
            $targetFolder = 'Domain';
            $target = $this->option('domain');
        } else {
            $targetFolder = 'Modules';
            $target = $this->option('module');
        }

        return sprintf("%s\%s\%s",
            $rootNamespace,
            $targetFolder,
            str_replace('/', '\\', $target)
        );
    }
}

