<?php

declare(strict_types=1);

namespace Infrastructure\Middleware\ConnectionExternal;

use Exception;
use Http\StatusHttp;
use ApiCore\Exception\Config;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Infrastructure\Util\Enum\ExternalServices;
use Infrastructure\Exception\CheckConnectionExternalException;
use Infrastructure\Service\DatabaseSabium\SabiumDatabaseConnectionCheckService;

class CheckConnectionsExternalMiddleware implements MiddlewareInterface
{
    /**
     * @var array
     */
    private array $configRoutes;

    /**
     * @var SabiumDatabaseConnectionCheckService
     */
    private SabiumDatabaseConnectionCheckService $checkConnectionDatabaseSabium;

    public function __construct(
        array $configRoutes,
        SabiumDatabaseConnectionCheckService $checkConnectionDatabaseSabium
    ) {
        $this->configRoutes = $configRoutes;
        $this->checkConnectionDatabaseSabium = $checkConnectionDatabaseSabium;
    }

    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     * @throws CheckConnectionExternalException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $request->getAttribute('Zend\Expressive\Router\RouteResult')->getMatchedRouteName();

        if ($route) {
            if (array_key_exists($route, $this->configRoutes)) {
                $errors = [];
                foreach ($this->configRoutes[$route] as $valueRoute) {
                    if ($valueRoute == ExternalServices::DATABASE) {
                        try {
                            $this->checkConnectionDatabaseSabium->checkConnectionDatabaseSabium();
                        } catch (Exception $e) {
                            array_push($errors, 'Sem conexao com banco de dados!');
                        }
                    }
                }

                if ($errors) {
                    throw new CheckConnectionExternalException(
                        (new Config())
                            ->setArrayError($errors)
                            ->setStatusCode(StatusHttp::INTERNAL_SERVER_ERROR)
                    );
                }
            }
        }
        return $handler->handle($request);
    }
}
