<?php

declare(strict_types=1);

namespace Infrastructure\Middleware\RequestLog;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LogRequestMiddleware implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $logRequest = sprintf(
            "\n[REQUEST]\nCLIENT: %s \nURI: %s \nMETHOD [%s] \nPARAMS [%s] \nUSER_AGENT: %s\nBODY: %s\n",
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_HOST'] .
                $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['QUERY_STRING'],
            $_SERVER['HTTP_USER_AGENT'],
            $request->getBody()->getContents()
        );
        $retorno = $handler->handle($request);

        $logResponse = sprintf(
            "\n[RESPONSE]\nSTATUS_CODE: %s \nBODY: %s \n\n",
            $retorno->getStatusCode(),
            json_encode(json_decode($retorno->getBody()->getContents()), JSON_PRETTY_PRINT),
            $logRequest
        );

        $this->logger->info($logRequest . $logResponse); # log_txt

        return $retorno;
    }
}
