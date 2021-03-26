<?php

declare(strict_types=1);

namespace Shared\Middleware;

use Psr\Container\ContainerInterface;

final class LoadConfigDataMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): LoadConfigDataMiddleware
    {
        return new LoadConfigDataMiddleware($container);
    }
}
