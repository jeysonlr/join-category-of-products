<?php

declare(strict_types=1);

namespace Infrastructure\Middleware;

use Psr\Container\ContainerInterface;

class ErrorHandlerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ErrorHandlerMiddleware
    {
        return new ErrorHandlerMiddleware();
    }
}
