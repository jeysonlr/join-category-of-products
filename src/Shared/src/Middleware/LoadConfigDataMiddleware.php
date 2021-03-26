<?php

declare(strict_types=1);

namespace Shared\Middleware;

use ApiCore\LoadConfigData;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class LoadConfigDataMiddleware implements MiddlewareInterface
{
    public function __construct(ContainerInterface $container)
    {
        LoadConfigData::setContainer($container);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request);
    }
}
