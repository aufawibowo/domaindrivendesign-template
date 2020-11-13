<?php

namespace A7Pro\Marketplace\Toko;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $container = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'A7Pro\Marketplace\Toko\Core\Domain\Exceptions' => __DIR__ . '/Core/Domain/Exceptions',
            'A7Pro\Marketplace\Toko\Core\Domain\Models' => __DIR__ . '/Core/Domain/Models',
            'A7Pro\Marketplace\Toko\Core\Domain\Repositories' => __DIR__ . '/Core/Domain/Repositories',
            'A7Pro\Marketplace\Toko\Core\Domain\Services' => __DIR__ . '/Core/Domain/Services',
            'A7Pro\Marketplace\Toko\Core\Application\Services' => __DIR__ . '/Core/Application/Services',
            'A7Pro\Marketplace\Toko\Infrastructure\Persistence' => __DIR__ . '/Infrastructure/Persistence',
            'A7Pro\Marketplace\Toko\Infrastructure\Services' => __DIR__ . '/Infrastructure/Services',
            'A7Pro\Marketplace\Toko\Presentation\Controllers' => __DIR__ . '/Presentation/Controllers',
        ]);

        $loader->register();
    }

    public function registerServices(DiInterface $container)
    {
        include __DIR__ . '/config/services.php';
    }
}
