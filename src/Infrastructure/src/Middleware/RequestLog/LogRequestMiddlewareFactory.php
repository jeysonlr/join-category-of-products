<?php

declare(strict_types=1);

namespace Infrastructure\Middleware\RequestLog;

use Infrastructure\Container\MonologFactory;
use Psr\Container\ContainerInterface;

class LogRequestMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): LogRequestMiddleware
    {
        $monolog = $container->get(MonologFactory::class);
        return new LogRequestMiddleware(
            $monolog
        );
    }
}
